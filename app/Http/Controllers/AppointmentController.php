<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\ClinicalSession;
use App\Models\PatientRecord;
use App\Models\Service;
use App\Models\User;
use App\Services\AppointmentService;
use App\Support\ClinicFormatter;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class AppointmentController extends Controller
{
    public function __construct(private AppointmentService $service) {}

    public function slots(Request $r)
    {
        $v = $r->validate(['dentist_id' => 'nullable|integer|exists:users,id', 'date' => 'required|date', 'service_id' => 'nullable|exists:services,id']);
        $dentists = User::whereIn('role', ['dentist', 'admin'])->when(! empty($v['dentist_id']), fn ($q) => $q->whereKey($v['dentist_id']))->pluck('id');
        if ($dentists->isEmpty()) {
            return response()->json([]);
        }
        $service = empty($v['service_id']) ? null : Service::findOrFail($v['service_id']);
        $day = Carbon::parse($v['date']);
        $slots = [];
        foreach (range(9, 16) as $hour) {
            foreach ([0, 30] as $minute) {
                $start = $day->copy()->setTime($hour, $minute);
                $end = $start->copy()->addMinutes($service?->duration_minutes ?? 30);
                if ($start->format('H:i') > '16:00' || $end->format('H:i') > '17:00') {
                    continue;
                }
                $available = $start->isFuture() && $dentists->contains(fn ($id) => $this->service->slotAvailable((int) $id, $start->toDateTimeString(), $end->toDateTimeString()));
                $slots[] = ['starts_at' => $start->toDateTimeString(), 'available' => $available];
            }
        }

        return response()->json($slots)->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
    }

    public function store(Request $r)
    {
        if ($r->filled('guest_phone')) {
            $r->merge(['guest_phone' => ClinicFormatter::normalizePhone((string) $r->input('guest_phone'))]);
        }

        $v = $r->validate(['guest_name' => ['required', 'regex:/^[a-zA-Z\s]+$/', 'max:200'], 'guest_phone' => ['required', 'regex:/^9[0-9]{9}$/'], 'guest_email' => 'nullable|email|max:255', 'dentist_id' => 'nullable|integer|exists:users,id', 'service_id' => 'required|exists:services,id', 'starts_at' => 'required|date|after:now', 'source' => 'required|in:online,walk_in,staff', 'patient_id' => 'nullable|exists:patient_records,id', 'intake_details' => 'nullable|array']);
        if (! empty($v['dentist_id'])) {
            abort_unless(User::whereKey($v['dentist_id'])->whereIn('role', ['dentist', 'admin'])->exists(), 422);
        }
        if ($v['source'] !== 'online') {
            abort_unless(auth()->check() && in_array(auth()->user()->role, ['front_desk', 'admin'], true), 403);
        }
        $intake = $v['intake_details'] ?? [];
        $patient = null;
        if (! empty($v['patient_id'])) {
            $patient = PatientRecord::find($v['patient_id']);
        }
        if (! $patient && ! empty($v['guest_phone'])) {
            $patient = PatientRecord::where('phone', $v['guest_phone'])->first();
        }
        if (! $patient && ! empty($v['guest_email'])) {
            $patient = PatientRecord::where('email', $v['guest_email'])->first();
        }
        $v['patient_id'] = $patient?->id;

        $start = Carbon::parse($v['starts_at']);
        $service = Service::findOrFail($v['service_id']);
        abort_unless($service->active, 422);
        $v['ends_at'] = $start->copy()->addMinutes($service->duration_minutes)->toDateTimeString();
        $v['status'] = $v['source'] === 'online' ? 'Pending Verification' : 'Pending';
        if (empty($v['dentist_id'])) {
            $a = DB::transaction(function () use ($v) {
                $dentists = User::whereIn('role', ['dentist', 'admin'])->orderBy('id')->lockForUpdate()->get();
                foreach ($dentists as $dentist) {
                    if (! $this->service->slotAvailable((int) $dentist->id, $v['starts_at'], $v['ends_at'])) {
                        continue;
                    }
                    $candidate = $v;
                    $candidate['dentist_id'] = $dentist->id;

                    return $this->service->create($candidate);
                }
                throw ValidationException::withMessages(['starts_at' => 'No dentist is available for this time.']);
            });
        } else {
            $a = $this->service->create($v);
        }

        return response()->json(['id' => $a->id, 'status' => $a->status, 'patient_id' => $a->patient_id], 201);
    }

    public function index(Request $r)
    {
        Appointment::autoMarkNoShows();
        $v = $r->validate(['dentist_id' => 'nullable|exists:users,id', 'status' => 'nullable|string', 'date' => 'nullable|date', 'from' => 'nullable|date', 'to' => 'nullable|date|after_or_equal:from', 'per_page' => 'nullable|integer|min:1|max:100']);
        $q = Appointment::with(['service', 'dentist', 'patient']);
        if ($r->user()->role === 'dentist' || ($r->user()->role === 'admin' && $r->query('view') === 'dentist')) {
            $q->where('dentist_id', $r->user()->id);
        }
        if ($r->user()->role === 'front_desk' && ! $r->filled('date') && ! $r->filled('from')) {
            $q->where('starts_at', '>=', now()->subHours(24));
        }
        $q->when($r->filled('dentist_id'), fn ($query) => $query->where('dentist_id', $v['dentist_id']))
            ->when($r->filled('status'), fn ($query) => $query->where('status', $v['status']))
            ->when($r->filled('date'), fn ($query) => $query->whereDate('starts_at', $v['date']))
            ->when($r->filled('from'), fn ($query) => $query->whereDate('starts_at', '>=', $v['from']))
            ->when($r->filled('to'), fn ($query) => $query->whereDate('starts_at', '<=', $v['to']));

        return response()->json($q->latest('starts_at')->paginate($v['per_page'] ?? 25));
    }

    public function verify(Request $r, Appointment $appointment)
    {
        abort_unless($appointment->status === 'Pending Verification', 422);
        $v = $r->validate(['patient_id' => 'nullable|exists:patient_records,id']);
        $patientId = $v['patient_id'] ?? $appointment->patient_id;
        if (! $patientId) {
            $patient = PatientRecord::where('phone', $appointment->guest_phone)
                ->when($appointment->guest_email, fn ($q) => $q->orWhere('email', $appointment->guest_email))
                ->first();
            $patientId = $patient?->id;
        }
        $appointment->update([
            'patient_id' => $patientId,
            'verified_at' => now(),
            'verified_by' => $r->user()->id,
            'status' => 'Pending',
        ]);

        return response()->json($appointment->fresh()->load(['service', 'dentist', 'patient']));
    }

    public function matches(Appointment $appointment)
    {
        abort_unless($appointment->status === 'Pending Verification', 422);

        return PatientRecord::query()->where(fn ($q) => $q->where('phone', $appointment->guest_phone)->when($appointment->guest_email, fn ($q) => $q->orWhere('email', $appointment->guest_email)))->limit(10)->get();
    }

    public function notes(Request $r, Appointment $appointment)
    {
        abort_unless(in_array($r->user()->role, ['admin', 'dentist'], true), 403);
        if ($r->user()->role === 'dentist' && $appointment->dentist_id) {
            abort_unless($appointment->dentist_id === $r->user()->id, 403);
        }
        abort_unless(in_array($appointment->status, ['Checked In', 'In Progress'], true), 403);
        $v = $r->validate(['dental_chart' => 'nullable|array', 'treatment_notes' => 'nullable|string|max:50000', 'prescriptions' => 'nullable|string|max:50000']);

        return ClinicalSession::updateOrCreate(['appointment_id' => $appointment->id], array_merge($v, ['dentist_id' => $appointment->dentist_id ?? $r->user()->id, 'patient_id' => $appointment->patient_id]));
    }

    public function detail(Request $r, Appointment $appointment)
    {
        abort_unless(in_array($r->user()->role, ['admin', 'dentist', 'front_desk'], true), 403);
        if ($r->user()->role === 'dentist' && $appointment->dentist_id) {
            abort_unless($appointment->dentist_id === $r->user()->id, 403);
        }

        Appointment::autoMarkNoShows();
        $appointment->refresh()->load(['service', 'dentist', 'patient', 'clinicalSession.prescriptionRecords']);

        if ($appointment->clinicalSession
            && trim((string) ($appointment->clinicalSession->prescriptions ?? '')) === ''
            && $appointment->clinicalSession->prescriptionRecords->isNotEmpty()) {
            $summary = $appointment->clinicalSession->prescriptionRecords
                ->map(function ($rx) {
                    return implode("\n", array_filter([
                        $rx->medication ? 'Medication: '.$rx->medication : null,
                        $rx->dosage ? 'Dosage: '.$rx->dosage : null,
                        $rx->frequency ? 'Frequency: '.$rx->frequency : null,
                        $rx->instructions ? 'Instructions: '.$rx->instructions : null,
                    ]));
                })
                ->filter()
                ->implode("\n\n");

            $appointment->clinicalSession->setAttribute('prescriptions', $summary ?: null);
        }

        return response()->json($appointment);
    }

    public function startAssessment(Request $r, Appointment $appointment)
    {
        abort_unless(in_array($r->user()->role, ['admin', 'dentist'], true), 403);
        if ($r->user()->role === 'dentist' && ! $appointment->dentist_id) {
            $appointment->update(['dentist_id' => $r->user()->id]);
        }
        if ($r->user()->role === 'dentist') {
            abort_unless($appointment->dentist_id === $r->user()->id, 403);
        }
        abort_unless(in_array($appointment->status, ['Checked In', 'In Progress'], true), 422, 'The patient must be Checked In before starting the assessment.');
        abort_unless($appointment->starts_at->isToday() || $appointment->status === 'In Progress', 422, 'Clinical assessment can only be started on the scheduled appointment date.');
        if (! $appointment->patient_id) {
            $existing = PatientRecord::where('phone', $appointment->guest_phone)
                ->when($appointment->guest_email, fn ($q) => $q->orWhere('email', $appointment->guest_email))
                ->first();
            if ($existing) {
                $appointment->update(['patient_id' => $existing->id]);
            }
        }
        $appointment->update(['status' => 'In Progress']);
        $session = ClinicalSession::firstOrCreate(['appointment_id' => $appointment->id], ['dentist_id' => $appointment->dentist_id ?? $r->user()->id, 'patient_id' => $appointment->patient_id]);
        if (! $session->patient_id && $appointment->patient_id) {
            $session->update(['patient_id' => $appointment->patient_id]);
        }

        return response()->json(['appointment' => $appointment->fresh()->load(['service', 'dentist', 'patient']), 'assessment' => $session]);
    }

    public function complete(Request $r, Appointment $appointment)
    {
        abort_unless(in_array($r->user()->role, ['admin', 'dentist'], true), 403);
        abort_unless($appointment->dentist_id === $r->user()->id, 403);
        $v = $r->validate([
            'clinical_findings' => 'nullable|string|max:10000',
            'diagnosis' => 'nullable|string|max:10000',
            'treatment_recommendations' => 'nullable|string|max:10000',
            'dentist_notes' => 'nullable|string|max:50000',
            'xrays' => 'nullable|array',
            'treatment_notes' => 'nullable|string|max:50000',
            'prescriptions' => 'nullable|string|max:50000',
            'prescription_details' => 'nullable|array',
            'prescription_details.medication' => 'nullable|string|max:255',
            'prescription_details.dosage' => 'nullable|string|max:255',
            'prescription_details.frequency' => 'nullable|string|max:255',
            'prescription_details.instructions' => 'nullable|string|max:5000',
        ]);
        if (isset($v['clinical_findings'])) {
            $v['clinical_findings'] = [$v['clinical_findings']];
        }

        return response()->json($this->service->complete($appointment, (int) $r->user()->id, $v));
    }

    public function changeStatus(Request $r, Appointment $appointment)
    {
        $v = $r->validate(['status' => 'required|in:Pending,Scheduled,Checked In,In Progress,Cancelled,No-Show', 'cancellation_reason' => 'required_if:status,Cancelled|nullable|string|max:255']);
        if ($v['status'] === 'Checked In') {
            abort_unless($appointment->starts_at->isToday(), 422, 'Cannot check in an appointment scheduled for a future date. Please reschedule the appointment date to today first if the patient arrived today.');
        }
        if (in_array($r->user()->role, ['admin', 'dentist'], true) && $v['status'] === 'In Progress') {
            abort_unless($appointment->dentist_id === $r->user()->id, 403, 'Only the assigned dentist can start a clinical visit.');
        }
        if ($r->user()->role === 'dentist') {
            abort_unless($appointment->dentist_id === $r->user()->id, 403);
        }
        $allowed = ['Pending Verification' => ['Pending', 'Scheduled', 'Cancelled'], 'Pending' => ['Scheduled', 'Checked In', 'Cancelled', 'No-Show'], 'Scheduled' => ['Pending', 'Checked In', 'Cancelled', 'No-Show'], 'Checked In' => ['In Progress', 'Cancelled'], 'In Progress' => ['Cancelled'], 'Completed' => [], 'Cancelled' => [], 'No-Show' => []];
        abort_unless($v['status'] === $appointment->status || in_array($v['status'], $allowed[$appointment->status] ?? [], true), 422, 'Invalid status transition.');
        if ($r->user()->role === 'admin') {
            abort_unless(in_array($v['status'], ['Scheduled', 'Checked In', 'In Progress', 'Cancelled', 'No-Show'], true), 403);
        }
        if ($r->user()->role === 'front_desk') {
            abort_unless(in_array($v['status'], ['Pending', 'Scheduled', 'Checked In', 'Cancelled'], true), 403);
        }
        if ($r->user()->role === 'dentist') {
            abort_unless(in_array($v['status'], ['In Progress', 'Cancelled'], true), 403);
        }
        $appointment->fill($v);
        if ($v['status'] === 'Checked In' && ! $appointment->checked_in_at) {
            $appointment->checked_in_at = now();
        }
        if ($v['status'] === 'Cancelled' && ! $appointment->cancelled_at) {
            $appointment->cancelled_at = now();
        }
        $appointment->save();

        return response()->json($appointment->fresh()->load(['service', 'dentist', 'patient']));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\ClinicalSession;
use App\Models\DentalChartEntry;
use App\Models\DentistBlock;
use App\Models\PatientRecord;
use App\Models\PatientToothRecord;
use App\Models\Service;
use App\Models\Tooth;
use App\Models\Transaction;
use App\Models\User;
use App\Services\AppointmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClinicController extends Controller
{
    private function admin(Request $r): void
    {
        abort_unless($r->user()->role === 'admin' || $r->user()->role === 'super_admin', 403);
    }

    private function clinical(Request $r, Appointment $a): void
    {
        abort_unless($r->user()->role === 'admin' || ($r->user()->role === 'dentist' && ($a->dentist_id === $r->user()->id || ! $a->dentist_id)), 403);
        if ($r->user()->role === 'dentist' && ! $a->dentist_id) {
            $a->update(['dentist_id' => $r->user()->id]);
        }abort_unless(in_array($a->status, ['Checked In', 'In Progress'], true), 403, 'Clinical editing requires a checked-in or in-progress appointment.');
    }

    public function workspace(Request $r)
    {
        Appointment::autoMarkNoShows();
        $role = $r->user()->role;
        $today = Appointment::query()->whereDate('starts_at', now()->toDateString());
        $scopedToDentist = $role === 'dentist' || ($role === 'admin' && $r->query('view') === 'dentist');
        if ($scopedToDentist) {
            $today->where('dentist_id', $r->user()->id);
        }
        $rows = $today->get();
        $upcoming = Appointment::query()->where('starts_at', '>', now())->where('starts_at', '<=', now()->addDays(7))->whereNotIn('status', ['Cancelled', 'No-Show']);
        $pending = Appointment::query()->where('status', 'Pending Verification')->whereBetween('starts_at', [now(), now()->addHours(48)]);
        if ($scopedToDentist) {
            $upcoming->where('dentist_id', $r->user()->id);
            $pending->where('dentist_id', $r->user()->id);
        }
        $collections = Transaction::query()->where('status', 'completed')->whereDate('created_at', now()->toDateString());
        if ($scopedToDentist) {
            $collections->whereHas('appointment', fn ($q) => $q->where('dentist_id', $r->user()->id));
        }
        $metrics = [
            'patients_today' => $rows->pluck('patient_id')->filter()->unique()->count() + $rows->whereNull('patient_id')->count(),
            'appointments_today' => $rows->count(),
            'total_patients_today' => $rows->pluck('patient_id')->filter()->unique()->count() + $rows->whereNull('patient_id')->count(),
            'walk_ins_today' => $rows->where('source', 'walk_in')->count(),
            'arrived_scheduled_today' => $rows->where('source', '!=', 'walk_in')->whereIn('status', ['Checked In', 'In Progress', 'Completed'])->count(),
            'scheduled_arrivals_today' => $rows->where('source', '!=', 'walk_in')->whereIn('status', ['Checked In', 'In Progress', 'Completed'])->count(),
            'completed_today' => $rows->where('status', 'Completed')->count(),
            'scheduled_today' => $rows->whereIn('status', ['Pending', 'Scheduled', 'Checked In', 'In Progress'])->count(),
            'cancelled_today' => $rows->whereIn('status', ['Cancelled', 'No-Show'])->count(),
            'checked_in_today' => $rows->where('status', 'Checked In')->count(),
            'in_progress_today' => $rows->where('status', 'In Progress')->count(),
            'pending_verifications' => $pending->count(),
            'upcoming_appointments' => $upcoming->count(),
            'total_patients' => PatientRecord::whereHas('appointments', fn ($q) => $q->where('status', 'Completed')->when($scopedToDentist, fn ($q2) => $q2->where('dentist_id', $r->user()->id)))->count(),
            'collections_today' => (float) $collections->sum('amount'),
            'total_registered_patients' => PatientRecord::whereHas('appointments', fn ($q) => $q->where('status', 'Completed')->when($scopedToDentist, fn ($q2) => $q2->where('dentist_id', $r->user()->id)))->count(),
            'new_registrations_month' => PatientRecord::whereHas('appointments', fn ($q) => $q->where('status', 'Completed')->when($scopedToDentist, fn ($q2) => $q2->where('dentist_id', $r->user()->id)))->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count(),
            'month_name' => now()->format('F Y'),
            'recall_contacts_due' => PatientRecord::whereHas('appointments', fn ($q) => $q->where('status', 'Completed')->when($scopedToDentist, fn ($q2) => $q2->where('dentist_id', $r->user()->id)))->whereDoesntHave('appointments', fn ($q) => $q->where('starts_at', '>=', now()->subMonths(6)))->count(),
            'profiles_needing_update' => PatientRecord::whereHas('appointments', fn ($q) => $q->where('status', 'Completed')->when($scopedToDentist, fn ($q2) => $q2->where('dentist_id', $r->user()->id)))->where(fn ($q) => $q->whereNull('phone')->orWhere('phone', '')->orWhereNull('email')->orWhere('email', '')->orWhereNull('date_of_birth'))->count(),
        ];
        $apptQuery = Appointment::with(['patient', 'service', 'dentist'])->latest('starts_at');
        if ($role === 'front_desk') {
            $apptQuery->where('starts_at', '>=', now()->subHours(24));
        }
        $appointments = $apptQuery->get();
        $patients = PatientRecord::whereHas('appointments', fn ($q) => $q->where('status', 'Completed')->when($scopedToDentist, fn ($q2) => $q2->where('dentist_id', $r->user()->id)))
            ->with(['appointments' => fn ($q) => $q->where('status', 'Completed')->with(['service', 'dentist'])->latest('starts_at')])
            ->latest()->get();
        $services = Service::where('active', true)->orderBy('name')->get();
        $dentists = User::whereIn('role', ['dentist', 'admin'])->orderBy('name')->get();
        $queueQuery = Appointment::with(['patient', 'service', 'dentist'])
            ->whereDate('starts_at', now()->toDateString());
        if ($role === 'front_desk') {
            $queueQuery->where('status', 'Checked In')
                ->orderByRaw('COALESCE(checked_in_at, starts_at) asc');
        } else {
            $queueQuery->whereIn('status', ['In Progress', 'Checked In', 'Scheduled', 'Pending', 'Completed'])
                ->orderByRaw("CASE WHEN status = 'In Progress' THEN 1 WHEN status = 'Checked In' THEN 2 WHEN status = 'Scheduled' THEN 3 WHEN status = 'Pending' THEN 4 WHEN status = 'Completed' THEN 5 ELSE 6 END")
                ->orderBy('starts_at');
        }
        $queueAppointments = $queueQuery->get();

        return match ($role) {
            'front_desk' => view('workspaces.front-desk.index', compact('metrics', 'appointments', 'patients', 'services', 'dentists', 'queueAppointments')),
            'dentist' => view('workspaces.dentist.index', compact('metrics')),
            'admin' => view('workspaces.admin.index', compact('metrics', 'appointments', 'patients', 'services', 'dentists', 'queueAppointments')),
            'super_admin' => view('workspaces.super-admin.index'),
            default => view('workspaces.patient.index')
        };
    }

    public function services(Request $r)
    {
        return Service::withCount('appointments')->orderBy('name')->get();
    }

    public function saveService(Request $r, ?Service $service = null)
    {
        $this->admin($r);
        $v = $r->validate(['name' => 'required|string|max:200', 'price' => 'required|numeric|min:0', 'duration_minutes' => 'required|integer|min:5|max:480', 'active' => 'sometimes|boolean']);
        $model = $service ?? new Service;
        $model->fill($v)->save();

        return response()->json($model, $service ? 200 : 201);
    }

    public function deleteService(Request $r, Service $service)
    {
        $this->admin($r);
        abort_if($service->appointments()->exists(), 409, 'Service is used by appointments; deactivate it instead.');
        $service->delete();

        return response()->noContent();
    }

    public function blocks(Request $r)
    {
        $q = DentistBlock::query();
        if ($r->user()->role === 'dentist') {
            $q->where('dentist_id', $r->user()->id);
        }

        return $q->orderBy('starts_at')->paginate(100);
    }

    public function saveBlock(Request $r, AppointmentService $service)
    {
        $v = $r->validate(['dentist_id' => 'required|exists:users,id', 'starts_at' => 'required|date|after:now', 'ends_at' => 'required|date|after:starts_at', 'reason' => 'nullable|string|max:255']);
        abort_unless($r->user()->role === 'admin' || ($r->user()->role === 'dentist' && (int) $v['dentist_id'] === $r->user()->id), 403);
        $block = DB::transaction(function () use ($v) {
            DB::table('users')->where('id', $v['dentist_id'])->lockForUpdate()->first();
            abort_if(Appointment::where('dentist_id', $v['dentist_id'])->whereNotIn('status', ['Cancelled', 'No-Show'])->where('starts_at', '<', $v['ends_at'])->where('ends_at', '>', $v['starts_at'])->exists(), 422, 'Conflicts with an appointment.');

            return DentistBlock::create($v);
        });

        return response()->json($block, 201);
    }

    public function deleteBlock(Request $r, DentistBlock $block)
    {
        abort_unless($r->user()->role === 'admin' || ($r->user()->role === 'dentist' && $block->dentist_id === $r->user()->id), 403);
        $block->delete();

        return response()->noContent();
    }

    public function reassign(Request $r, Appointment $appointment, AppointmentService $service)
    {
        abort_unless(in_array($r->user()->role, ['admin', 'front_desk'], true), 403);
        $v = $r->validate(['dentist_id' => 'required|exists:users,id']);
        abort_unless(User::whereKey($v['dentist_id'])->whereIn('role', ['dentist', 'admin'])->exists(), 422);
        DB::transaction(function () use ($v, $appointment, $service) {
            DB::table('users')->where('id', $v['dentist_id'])->lockForUpdate()->first();
            abort_unless($service->slotAvailable((int) $v['dentist_id'], $appointment->starts_at->toDateTimeString(), $appointment->ends_at->toDateTimeString(), $appointment->id), 422, 'Unavailable schedule');
            $appointment->update($v);
        });

        return $appointment;
    }

    public function chart(Request $r, PatientRecord $patient)
    {
        abort_unless(in_array($r->user()->role, ['dentist', 'admin'], true), 403);
        if ($r->user()->role === 'dentist' && $r->user()->id) {
            abort_unless($patient->appointments()->where('dentist_id', $r->user()->id)->exists() || ! $patient->appointments()->exists(), 403);
        }

        return ['patient' => $patient, 'teeth' => Tooth::orderBy('fdi_number')->get(), 'current' => PatientToothRecord::where('patient_id', $patient->id)->get(), 'history' => DentalChartEntry::where('patient_id', $patient->id)->latest()->paginate(100)];
    }

    public function saveTooth(Request $r, Appointment $appointment)
    {
        $this->clinical($r, $appointment);
        if (! $appointment->patient_id) {
            $existing = PatientRecord::where('phone', $appointment->guest_phone)
                ->when($appointment->guest_email, fn ($q) => $q->orWhere('email', $appointment->guest_email))
                ->first();
            if ($existing) {
                $appointment->update(['patient_id' => $existing->id]);
            }
        }

        $tooth = $this->resolveToothReference($r);
        $r->merge(['tooth_id' => $tooth->id]);
        $v = $r->validate([
            'tooth_id' => 'required|exists:teeth,id',
            'condition' => 'required|string|max:100',
            'surfaces' => 'nullable|array',
            'surfaces.*' => 'string|in:M,D,O,I,B,L,P',
            'notes' => 'nullable|string|max:10000',
        ]);

        return DB::transaction(function () use ($appointment, $r, $v, $tooth) {
            $session = ClinicalSession::firstOrCreate(
                ['appointment_id' => $appointment->id],
                ['dentist_id' => $appointment->dentist_id ?? $r->user()->id, 'patient_id' => $appointment->patient_id]
            );
            if (! $session->patient_id && $appointment->patient_id) {
                $session->update(['patient_id' => $appointment->patient_id]);
            }
            $entry = DentalChartEntry::create([
                'clinical_session_id' => $session->id,
                'patient_id' => $appointment->patient_id,
                'dentist_id' => $r->user()->id,
            ] + $v);
            if ($appointment->patient_id) {
                PatientToothRecord::updateOrCreate(
                    ['patient_id' => $appointment->patient_id, 'tooth_id' => $v['tooth_id']],
                    [
                        'condition' => $v['condition'],
                        'surface_conditions' => $v['surfaces'] ?? null,
                        'notes' => $v['notes'] ?? null,
                        'last_updated_by' => $r->user()->id,
                    ]
                );
            }

            return response()->json([
                'entry' => $entry,
                'patient_id' => $appointment->patient_id,
                'tooth' => $tooth,
                'message' => 'Tooth record successfully saved.',
            ], 201);
        });
    }

    public function savePatientTooth(Request $r, PatientRecord $patient)
    {
        abort_unless(in_array($r->user()->role, ['dentist', 'admin'], true), 403);

        $tooth = $this->resolveToothReference($r);
        $r->merge(['tooth_id' => $tooth->id]);
        $v = $r->validate([
            'tooth_id' => 'required|exists:teeth,id',
            'condition' => 'required|string|max:100',
            'surfaces' => 'nullable|array',
            'surfaces.*' => 'string|in:M,D,O,I,B,L,P',
            'notes' => 'nullable|string|max:10000',
        ]);

        return DB::transaction(function () use ($patient, $r, $v, $tooth) {
            $latestAppt = $patient->appointments()->where('status', 'Completed')->latest('starts_at')->first();
            if (! $latestAppt) {
                abort(422, 'Dental chart records require a completed patient visit.');
            }
            $session = ClinicalSession::firstOrCreate(
                ['appointment_id' => $latestAppt->id],
                ['dentist_id' => $latestAppt->dentist_id ?? $r->user()->id, 'patient_id' => $patient->id]
            );
            if (! $session->patient_id) {
                $session->update(['patient_id' => $patient->id]);
            }
            $entry = DentalChartEntry::create([
                'clinical_session_id' => $session->id,
                'patient_id' => $patient->id,
                'dentist_id' => $r->user()->id,
            ] + $v);
            PatientToothRecord::updateOrCreate(
                ['patient_id' => $patient->id, 'tooth_id' => $v['tooth_id']],
                [
                    'condition' => $v['condition'],
                    'surface_conditions' => $v['surfaces'] ?? null,
                    'notes' => $v['notes'] ?? null,
                    'last_updated_by' => $r->user()->id,
                ]
            );

            return response()->json([
                'entry' => $entry,
                'patient_id' => $patient->id,
                'tooth' => $tooth,
                'message' => 'Tooth record successfully saved.',
            ], 201);
        });
    }

    private function resolveToothReference(Request $r): Tooth
    {
        // New chart clients send FDI explicitly. This removes the ambiguity between
        // a database primary key and legacy Universal tooth numbers such as "11".
        $fdi = $r->input('tooth_fdi');
        if ($fdi !== null && $fdi !== '') {
            $tooth = Tooth::where('fdi_number', (int) $fdi)->first();
            abort_unless($tooth, 422, 'Unknown tooth reference.');

            return $tooth;
        }

        $toothInput = $r->input('tooth_id') ?? $r->input('tooth_number');
        $universalMap = [
            '1' => 18, '2' => 17, '3' => 16, '4' => 15, '5' => 14, '6' => 13, '7' => 12, '8' => 11,
            '9' => 21, '10' => 22, '11' => 23, '12' => 24, '13' => 25, '14' => 26, '15' => 27, '16' => 28,
            '17' => 38, '18' => 37, '19' => 36, '20' => 35, '21' => 34, '22' => 33, '23' => 32, '24' => 31,
            '25' => 41, '26' => 42, '27' => 43, '28' => 44, '29' => 45, '30' => 46, '31' => 47, '32' => 48,
            'A' => 55, 'B' => 54, 'C' => 53, 'D' => 52, 'E' => 51, 'F' => 61, 'G' => 62, 'H' => 63, 'I' => 64, 'J' => 65,
            'K' => 75, 'L' => 74, 'M' => 73, 'N' => 72, 'O' => 71, 'P' => 81, 'Q' => 82, 'R' => 83, 'S' => 84, 'T' => 85,
        ];
        $key = strtoupper(trim((string) $toothInput));

        // Hydrated charts send the real teeth.id. Keep that route compatible.
        if ($r->boolean('tooth_id_is_database_id') && is_numeric($toothInput)) {
            $tooth = Tooth::find((int) $toothInput);
            if ($tooth) {
                return $tooth;
            }
        }

        if (isset($universalMap[$key])) {
            $tooth = Tooth::where('fdi_number', $universalMap[$key])->first();
            if ($tooth) {
                return $tooth;
            }
        }

        if (is_numeric($toothInput)) {
            $tooth = Tooth::where('fdi_number', (int) $toothInput)->first();
            if ($tooth) {
                return $tooth;
            }
            $tooth = Tooth::find((int) $toothInput);
            if ($tooth) {
                return $tooth;
            }
        }

        abort(422, 'Unknown tooth reference.');
    }

    public function transactions(Request $r)
    {
        $this->admin($r);

        return Transaction::with(['appointment.service', 'appointment.dentist', 'patient', 'service'])->latest()->paginate($r->integer('per_page', 25));
    }

    public function recordPayment(Request $r)
    {
        abort_unless(in_array($r->user()->role, ['admin', 'super_admin', 'front_desk'], true), 403);
        $v = $r->validate([
            'appointment_id' => 'nullable|exists:appointments,id',
            'patient_id' => 'nullable|exists:patient_records,id',
            'service_id' => 'nullable|exists:services,id',
            'amount' => 'required|numeric|min:0.01',
            'payment_method' => 'required|string|max:50',
        ]);
        $appointment = ! empty($v['appointment_id']) ? Appointment::find($v['appointment_id']) : null;
        $patientId = $v['patient_id'] ?? $appointment?->patient_id;
        if (! $appointment && $patientId) {
            $appointment = Appointment::where('patient_id', $patientId)->latest('starts_at')->first();
        }
        $serviceId = $v['service_id'] ?? $appointment?->service_id;
        if ($appointment && $patientId && $appointment->patient_id && (int) $appointment->patient_id !== (int) $patientId) {
            abort(422, 'The selected treatment does not belong to this patient.');
        }
        if ($appointment && $serviceId && (int) $appointment->service_id !== (int) $serviceId) {
            abort(422, 'The selected service does not match this appointment.');
        }
        $service = $serviceId ? Service::find($serviceId) : $appointment?->service;

        if ($appointment && $service) {
            $alreadyPaid = (float) Transaction::where('appointment_id', $appointment->id)
                ->where('status', 'completed')
                ->sum('amount');
            $remaining = max(0, (float) $service->price - $alreadyPaid);
            abort_if($remaining <= 0, 422, 'This treatment has no outstanding balance.');

            $installmentEligible = (bool) preg_match('/ortho|brace/i', (string) $service->name);
            if (! $installmentEligible && abs((float) $v['amount'] - $remaining) > 0.009) {
                abort(422, 'The payable amount for this treatment is fixed at PHP '.number_format($remaining, 2).'.');
            }
            if ($installmentEligible && (float) $v['amount'] > $remaining + 0.009) {
                abort(422, 'Payment cannot exceed the remaining balance of PHP '.number_format($remaining, 2).'.');
            }
        }

        $t = Transaction::create([
            'appointment_id' => $appointment?->id,
            'patient_id' => $patientId,
            'service_id' => $serviceId,
            'recorded_by' => $r->user()->id,
            'status' => 'completed',
            'amount' => $v['amount'],
            'payment_method' => $v['payment_method'],
        ]);
        if ($appointment && in_array($appointment->status, ['Checked In', 'In Progress'], true)) {
            if (! $appointment->patient_id) {
                $intake = $appointment->intake_details ?? [];
                $patient = PatientRecord::firstOrCreate(
                    ['phone' => $appointment->guest_phone],
                    [
                        'patient_code' => PatientRecord::nextPatientCode(),
                        'name' => $appointment->guest_name ?: 'Guest Patient',
                        'date_of_birth' => $intake['date_of_birth'] ?? null,
                        'gender' => $intake['gender'] ?? null,
                        'email' => $appointment->guest_email,
                    ]
                );
                $appointment->patient_id = $patient->id;
                $t->update(['patient_id' => $patient->id]);
            }
            $appointment->update(['status' => 'Completed', 'patient_id' => $appointment->patient_id]);
        }

        return response()->json($t, 201);
    }

    public function voidPayment(Request $r, Transaction $transaction)
    {
        $this->admin($r);
        $v = $r->validate(['void_reason' => 'required|string|max:255']);
        abort_unless($transaction->status === 'completed', 422);
        $transaction->update(['status' => 'voided', 'void_reason' => $v['void_reason'], 'voided_by' => $r->user()->id, 'voided_at' => now()]);

        return $transaction;
    }
}

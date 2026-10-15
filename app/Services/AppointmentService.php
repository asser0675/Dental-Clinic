<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\ClinicalSession;
use App\Models\DentalChartEntry;
use App\Models\DentistBlock;
use App\Models\PatientRecord;
use App\Models\PatientToothRecord;
use App\Models\Prescription;
use App\Models\TreatmentRecord;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class AppointmentService
{
    public function slotAvailable(int $dentistId, string $start, string $end, ?int $except = null): bool
    {
        return ! Appointment::query()->where('dentist_id', $dentistId)->when($except, fn ($q) => $q->where('id', '!=', $except))->whereNotIn('status', ['Cancelled', 'No-Show'])->where('starts_at', '<', $end)->where('ends_at', '>', $start)->exists()
        && ! DentistBlock::where('dentist_id', $dentistId)->where('starts_at', '<', $end)->where('ends_at', '>', $start)->exists();
    }

    public function create(array $data): Appointment
    {
        return DB::transaction(function () use ($data) {
            // Lock the dentist row to serialize competing reservations for this dentist.
            DB::table('users')->where('id', $data['dentist_id'])->lockForUpdate()->first();
            if (! $this->slotAvailable($data['dentist_id'], $data['starts_at'], $data['ends_at'])) {
                throw ValidationException::withMessages(['starts_at' => 'Selected slot is unavailable for this dentist.']);
            }

            if (! empty($data['patient_id'])) {
                $patientConflict = Appointment::where('patient_id', $data['patient_id'])
                    ->whereNotIn('status', ['Cancelled', 'No-Show'])
                    ->where('starts_at', '<', $data['ends_at'])
                    ->where('ends_at', '>', $data['starts_at'])
                    ->exists();

                if ($patientConflict) {
                    throw ValidationException::withMessages(['starts_at' => 'This patient already has an appointment scheduled at this time.']);
                }
            }

            return Appointment::create($data);
        });
    }

    public function complete(Appointment $appointment, int $dentistId, array $details = []): Appointment
    {
        return DB::transaction(function () use ($appointment, $dentistId, $details) {
            $a = Appointment::whereKey($appointment->id)->lockForUpdate()->firstOrFail();
            if (! $a->dentist_id) {
                $a->update(['dentist_id' => $dentistId]);
            }

            $userRole = auth()->user()?->role ?? 'dentist';
            abort_unless(
                in_array($userRole, ['admin', 'dentist'], true)
                && ($a->dentist_id === $dentistId || $userRole === 'admin'),
                403
            );
            abort_unless(
                in_array($a->status, ['Checked In', 'In Progress', 'Completed'], true),
                422,
                'Only an in-progress or checked-in appointment may be completed.'
            );

            // A Patient Record becomes authoritative when the visit is completed.
            // Match an existing person first so repeated visits do not create duplicates.
            $patient = $a->patient ?: $this->resolveCompletedPatient($a);
            if (! $a->patient_id || (int) $a->patient_id !== (int) $patient->id) {
                $a->patient_id = $patient->id;
            }

            $prescriptionDetails = is_array($details['prescription_details'] ?? null)
                ? $details['prescription_details']
                : [];
            unset($details['prescription_details']);

            $prescriptionSummary = $this->formatPrescriptionSummary($prescriptionDetails);
            if ($prescriptionSummary !== null) {
                $details['prescriptions'] = $prescriptionSummary;
            }

            $session = ClinicalSession::firstOrCreate(
                ['appointment_id' => $a->id],
                ['dentist_id' => $a->dentist_id ?? $dentistId, 'patient_id' => $patient->id]
            );

            $sessionPayload = array_intersect_key($details, array_flip([
                'clinical_findings',
                'diagnosis',
                'treatment_recommendations',
                'dentist_notes',
                'xrays',
                'treatment_notes',
                'prescriptions',
            ]));
            $sessionPayload['patient_id'] = $patient->id;
            $sessionPayload['dentist_id'] = $a->dentist_id ?? $dentistId;
            $sessionPayload['finalized_at'] = now();
            $session->update($sessionPayload);

            if (! empty(trim((string) ($prescriptionDetails['medication'] ?? '')))) {
                Prescription::updateOrCreate(
                    ['clinical_session_id' => $session->id],
                    [
                        'patient_id' => $patient->id,
                        'medication' => trim((string) $prescriptionDetails['medication']),
                        'dosage' => $this->nullIfBlank($prescriptionDetails['dosage'] ?? null),
                        'frequency' => $this->nullIfBlank($prescriptionDetails['frequency'] ?? null),
                        'instructions' => $this->nullIfBlank($prescriptionDetails['instructions'] ?? null),
                    ]
                );
            }

            $chartEntries = DentalChartEntry::with('tooth')->where('clinical_session_id', $session->id)->orderBy('id')->get();
            foreach ($chartEntries as $entry) {
                $entry->update(['patient_id' => $patient->id]);
                PatientToothRecord::updateOrCreate(
                    ['patient_id' => $patient->id, 'tooth_id' => $entry->tooth_id],
                    [
                        'condition' => $entry->condition,
                        'surface_conditions' => $entry->surfaces,
                        'notes' => $entry->notes,
                        'last_updated_by' => $entry->dentist_id,
                    ]
                );
            }

            if ($chartEntries->isNotEmpty()) {
                $currentFindings = $session->clinical_findings;
                if (empty($currentFindings) || (is_array($currentFindings) && count($currentFindings) === 1 && preg_match('/^\d+\s+tooth findings/i', $currentFindings[0]))) {
                    $findingsList = [];
                    foreach ($chartEntries as $entry) {
                        $tLabel = $entry->tooth?->label ?: ('Tooth '.($entry->tooth?->id ?? ''));
                        $cond = $entry->condition ?: 'Documented';
                        $note = trim((string) ($entry->notes ?? ''));
                        $findingsList[] = $tLabel.': '.$cond.($note ? ' ('.$note.')' : '');
                    }
                    if (! empty($findingsList)) {
                        $session->update(['clinical_findings' => array_values(array_unique($findingsList))]);
                    }
                }

                if (empty($sessionPayload['diagnosis']) || $sessionPayload['diagnosis'] === 'Routine clinical assessment and monitoring.') {
                    $diagList = [];
                    foreach ($chartEntries as $entry) {
                        if ($entry->condition && ! in_array($entry->condition, ['Sound / Healthy'], true)) {
                            $tLabel = $entry->tooth?->label ?: ('Tooth '.($entry->tooth?->id ?? ''));
                            $diagList[] = $tLabel.': '.$entry->condition;
                        }
                    }
                    if (! empty($diagList)) {
                        $session->update(['diagnosis' => implode("\n", array_unique($diagList))]);
                    }
                }

                if (empty($sessionPayload['treatment_recommendations']) || $sessionPayload['treatment_recommendations'] === 'Routine oral hygiene & recall.') {
                    $treatList = [];
                    foreach ($chartEntries as $entry) {
                        if ($entry->condition && ! in_array($entry->condition, ['Sound / Healthy'], true)) {
                            $tLabel = $entry->tooth?->label ?: ('Tooth '.($entry->tooth?->id ?? ''));
                            $cond = strtolower((string) $entry->condition);
                            $proc = str_contains($cond, 'caries') || str_contains($cond, 'decay')
                                ? 'Composite Restoration'
                                : (str_contains($cond, 'extraction') ? 'Tooth Extraction' : $entry->condition);
                            $treatList[] = $tLabel.': '.$proc;
                        }
                    }
                    if (! empty($treatList)) {
                        $session->update(['treatment_recommendations' => implode("\n", array_unique($treatList))]);
                    }
                }
            }

            TreatmentRecord::where('clinical_session_id', $session->id)
                ->whereNull('patient_id')
                ->update(['patient_id' => $patient->id]);
            Prescription::where('clinical_session_id', $session->id)
                ->whereNull('patient_id')
                ->update(['patient_id' => $patient->id]);

            $a->status = 'Completed';
            $a->save();

            return $a->load(['patient', 'clinicalSession']);
        });
    }

    private function resolveCompletedPatient(Appointment $appointment): PatientRecord
    {
        $intake = is_array($appointment->intake_details) ? $appointment->intake_details : [];
        $phone = trim((string) ($appointment->guest_phone ?? ''));
        $email = trim((string) ($appointment->guest_email ?? ''));

        $patient = null;
        if ($phone !== '') {
            $patient = PatientRecord::where('phone', $phone)->first();
        }
        if (! $patient && $email !== '') {
            $patient = PatientRecord::where('email', $email)->first();
        }

        $values = [
            'name' => $appointment->guest_name ?: 'Guest Patient',
            'phone' => $phone !== '' ? $phone : null,
            'email' => $email !== '' ? $email : null,
            'date_of_birth' => $intake['date_of_birth'] ?? null,
            'gender' => $intake['gender'] ?? $intake['sex'] ?? null,
        ];

        if (! $patient) {
            return PatientRecord::create(['patient_code' => PatientRecord::nextPatientCode()] + $values);
        }

        // Preserve established patient information, but fill fields that were blank
        // when the patient first entered the system as an appointment request.
        $updates = [];
        foreach ($values as $field => $value) {
            if (($patient->{$field} === null || $patient->{$field} === '') && $value !== null && $value !== '') {
                $updates[$field] = $value;
            }
        }
        if (($patient->name === 'Guest Patient' || trim((string) $patient->name) === '') && $values['name'] !== 'Guest Patient') {
            $updates['name'] = $values['name'];
        }
        if ($updates) {
            $patient->update($updates);
        }

        return $patient->fresh();
    }

    private function formatPrescriptionSummary(array $details): ?string
    {
        $parts = [];
        $labels = [
            'medication' => 'Medication',
            'dosage' => 'Dosage',
            'frequency' => 'Frequency',
            'instructions' => 'Instructions',
        ];

        foreach ($labels as $key => $label) {
            $value = trim((string) ($details[$key] ?? ''));
            if ($value !== '') {
                $parts[] = $label.': '.$value;
            }
        }

        return $parts ? implode("\n", $parts) : null;
    }

    private function nullIfBlank(mixed $value): ?string
    {
        $value = trim((string) ($value ?? ''));

        return $value === '' ? null : $value;
    }
}

<?php

use App\Models\Appointment;
use App\Models\ClinicalSession;
use App\Models\DentalChartEntry;
use App\Models\PatientRecord;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        $appointments = Appointment::whereNull('patient_id')->get();
        foreach ($appointments as $appointment) {
            $intake = $appointment->intake_details ?? [];
            $phone = ! empty($appointment->guest_phone) ? $appointment->guest_phone : null;
            $email = ! empty($appointment->guest_email) ? $appointment->guest_email : null;

            $patient = null;
            if ($phone) {
                $patient = PatientRecord::where('phone', $phone)->first();
            }
            if (! $patient && $email) {
                $patient = PatientRecord::where('email', $email)->first();
            }

            if (! $patient) {
                $patient = PatientRecord::create([
                    'patient_code' => 'PT-'.strtoupper((string) Str::ulid()),
                    'name' => $appointment->guest_name ?: 'Guest Patient',
                    'phone' => $phone,
                    'email' => $email,
                    'date_of_birth' => ! empty($intake['date_of_birth']) ? $intake['date_of_birth'] : null,
                    'gender' => ! empty($intake['sex']) ? $intake['sex'] : (! empty($intake['gender']) ? $intake['gender'] : null),
                ]);
            }

            $appointment->update(['patient_id' => $patient->id]);

            $session = ClinicalSession::where('appointment_id', $appointment->id)->first();
            if ($session) {
                $session->update(['patient_id' => $patient->id]);
                DentalChartEntry::where('clinical_session_id', $session->id)->whereNull('patient_id')->update(['patient_id' => $patient->id]);
            }
        }
    }

    public function down(): void
    {
        // No reversal needed for data backfill
    }
};

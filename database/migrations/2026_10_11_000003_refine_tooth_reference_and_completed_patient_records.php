<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $this->clarifyToothReferenceData();
        $this->backfillCompletedPatientRecords();
    }

    public function down(): void
    {
        // Data-only normalization/backfill. It is intentionally not destructive on rollback.
    }

    private function clarifyToothReferenceData(): void
    {
        if (! Schema::hasTable('teeth')) {
            return;
        }

        $permanentNames = [
            1 => 'Central Incisor',
            2 => 'Lateral Incisor',
            3 => 'Canine',
            4 => 'First Premolar',
            5 => 'Second Premolar',
            6 => 'First Molar',
            7 => 'Second Molar',
            8 => 'Third Molar',
        ];
        $primaryNames = [
            1 => 'Central Incisor',
            2 => 'Lateral Incisor',
            3 => 'Canine',
            4 => 'First Molar',
            5 => 'Second Molar',
        ];

        foreach (DB::table('teeth')->get() as $tooth) {
            $quadrant = (int) $tooth->quadrant;
            $position = (int) $tooth->position;
            $isPrimary = $tooth->dentition === 'primary';
            $arch = in_array($quadrant, [1, 2, 5, 6], true) ? 'Maxillary' : 'Mandibular';
            $side = in_array($quadrant, [1, 4, 5, 8], true) ? 'Right' : 'Left';
            $name = ($isPrimary ? $primaryNames : $permanentNames)[$position] ?? 'Tooth';
            $prefix = $isPrimary ? 'Primary ' : '';

            DB::table('teeth')->where('id', $tooth->id)->update([
                'label' => trim($prefix.$arch.' '.$side.' '.$name),
                'updated_at' => now(),
            ]);
        }
    }

    private function backfillCompletedPatientRecords(): void
    {
        if (! Schema::hasTable('appointments') || ! Schema::hasTable('patient_records')) {
            return;
        }

        $appointments = DB::table('appointments')
            ->where('status', 'Completed')
            ->orderBy('id')
            ->get();

        foreach ($appointments as $appointment) {
            $intake = $this->decodeJson($appointment->intake_details ?? null);
            $phone = $this->normalizePhone($appointment->guest_phone ?? null);
            $email = trim((string) ($appointment->guest_email ?? '')) ?: null;
            $patient = null;

            if (! empty($appointment->patient_id)) {
                $patient = DB::table('patient_records')->where('id', $appointment->patient_id)->first();
            }
            if (! $patient && $phone) {
                $patient = DB::table('patient_records')->where('phone', $phone)->first();
            }
            if (! $patient && $email) {
                $patient = DB::table('patient_records')->where('email', $email)->first();
            }

            if (! $patient) {
                $patientId = DB::table('patient_records')->insertGetId([
                    'patient_code' => $this->nextPatientCode(),
                    'name' => trim((string) ($appointment->guest_name ?? '')) ?: 'Guest Patient',
                    'date_of_birth' => $intake['date_of_birth'] ?? null,
                    'gender' => $intake['gender'] ?? $intake['sex'] ?? null,
                    'phone' => $phone,
                    'email' => $email,
                    'user_id' => null,
                    'created_at' => $appointment->starts_at ?? now(),
                    'updated_at' => now(),
                ]);
                $patient = DB::table('patient_records')->where('id', $patientId)->first();
            } else {
                $updates = [];
                if ((! isset($patient->name) || trim((string) $patient->name) === '' || $patient->name === 'Guest Patient') && ! empty($appointment->guest_name)) {
                    $updates['name'] = trim((string) $appointment->guest_name);
                }
                if (empty($patient->phone) && $phone) {
                    $updates['phone'] = $phone;
                }
                if (empty($patient->email) && $email) {
                    $updates['email'] = $email;
                }
                if (empty($patient->date_of_birth) && ! empty($intake['date_of_birth'])) {
                    $updates['date_of_birth'] = $intake['date_of_birth'];
                }
                if (empty($patient->gender) && ! empty($intake['gender'] ?? $intake['sex'] ?? null)) {
                    $updates['gender'] = $intake['gender'] ?? $intake['sex'];
                }
                if ($updates) {
                    $updates['updated_at'] = now();
                    DB::table('patient_records')->where('id', $patient->id)->update($updates);
                }
            }

            $patientId = (int) $patient->id;
            DB::table('appointments')->where('id', $appointment->id)->update([
                'patient_id' => $patientId,
                'updated_at' => now(),
            ]);

            if (Schema::hasTable('clinical_sessions')) {
                DB::table('clinical_sessions')
                    ->where('appointment_id', $appointment->id)
                    ->update(['patient_id' => $patientId, 'updated_at' => now()]);

                $sessionIds = DB::table('clinical_sessions')
                    ->where('appointment_id', $appointment->id)
                    ->pluck('id');

                if ($sessionIds->isNotEmpty()) {
                    if (Schema::hasTable('dental_chart_entries')) {
                        DB::table('dental_chart_entries')
                            ->whereIn('clinical_session_id', $sessionIds)
                            ->update(['patient_id' => $patientId, 'updated_at' => now()]);
                    }
                    if (Schema::hasTable('treatment_records')) {
                        DB::table('treatment_records')
                            ->whereIn('clinical_session_id', $sessionIds)
                            ->update(['patient_id' => $patientId, 'updated_at' => now()]);
                    }
                    if (Schema::hasTable('prescriptions')) {
                        DB::table('prescriptions')
                            ->whereIn('clinical_session_id', $sessionIds)
                            ->update(['patient_id' => $patientId, 'updated_at' => now()]);
                    }
                }
            }
        }
    }

    private function nextPatientCode(): string
    {
        $year = now()->format('Y');
        $prefix = 'PT-'.$year.'-';
        $max = 0;

        foreach (DB::table('patient_records')->where('patient_code', 'like', $prefix.'%')->pluck('patient_code') as $code) {
            if (preg_match('/^PT-\d{4}-(\d+)$/', (string) $code, $matches)) {
                $max = max($max, (int) $matches[1]);
            }
        }

        return sprintf('%s%04d', $prefix, $max + 1);
    }

    private function normalizePhone(mixed $value): ?string
    {
        $digits = preg_replace('/\D+/', '', (string) ($value ?? ''));
        if ($digits === '') {
            return null;
        }
        if (str_starts_with($digits, '63') && strlen($digits) === 12) {
            $digits = substr($digits, 2);
        }
        if (str_starts_with($digits, '0') && strlen($digits) === 11) {
            $digits = substr($digits, 1);
        }

        return preg_match('/^9\d{9}$/', $digits) ? $digits : (trim((string) $value) ?: null);
    }

    private function decodeJson(mixed $value): array
    {
        if (is_array($value)) {
            return $value;
        }
        if (! is_string($value) || trim($value) === '') {
            return [];
        }
        $decoded = json_decode($value, true);

        return is_array($decoded) ? $decoded : [];
    }
};

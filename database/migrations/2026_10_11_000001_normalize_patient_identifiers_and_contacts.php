<?php

use App\Support\ClinicFormatter;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('patient_records')) {
            $patients = DB::table('patient_records')
                ->select('id', 'patient_code', 'phone', 'created_at')
                ->orderBy('id')
                ->get();

            // Preserve already-correct PT-YYYY-NNNN identifiers. Only legacy/malformed
            // identifiers are replaced so existing readable clinic IDs do not change.
            $nextByYear = [];
            foreach ($patients as $patient) {
                if (preg_match('/^PT-(\d{4})-(\d{4,})$/', strtoupper((string) $patient->patient_code), $matches)) {
                    $year = $matches[1];
                    $nextByYear[$year] = max($nextByYear[$year] ?? 0, (int) $matches[2]);
                }
            }

            foreach ($patients as $patient) {
                $updates = ['phone' => ClinicFormatter::normalizePhone($patient->phone)];
                $existingCode = strtoupper(trim((string) $patient->patient_code));

                if (! preg_match('/^PT-\d{4}-\d{4,}$/', $existingCode)) {
                    $year = $patient->created_at ? date('Y', strtotime((string) $patient->created_at)) : date('Y');
                    $nextByYear[$year] = ($nextByYear[$year] ?? 0) + 1;
                    $updates['patient_code'] = sprintf('PT-%s-%04d', $year, $nextByYear[$year]);
                }

                DB::table('patient_records')->where('id', $patient->id)->update($updates);
            }
        }

        if (Schema::hasTable('appointments')) {
            DB::table('appointments')
                ->select('id', 'guest_phone')
                ->orderBy('id')
                ->chunkById(200, function ($appointments): void {
                    foreach ($appointments as $appointment) {
                        $phone = ClinicFormatter::normalizePhone($appointment->guest_phone);
                        if ($phone !== null) {
                            DB::table('appointments')->where('id', $appointment->id)->update(['guest_phone' => $phone]);
                        }
                    }
                });
        }
    }

    public function down(): void
    {
        // Formatting-only data migration. Original textual formats cannot be reconstructed safely.
    }
};

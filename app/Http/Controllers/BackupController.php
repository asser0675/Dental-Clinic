<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\ClinicalSession;
use App\Models\DentalChartEntry;
use App\Models\DentistBlock;
use App\Models\PatientRecord;
use App\Models\Prescription;
use App\Models\Service;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class BackupController extends Controller
{
    protected string $backupDir;

    public function __construct()
    {
        $this->backupDir = storage_path('app/backups');
        if (! File::exists($this->backupDir)) {
            File::makeDirectory($this->backupDir, 0755, true);
        }
    }

    /**
     * Get list of all available backups and current system record counts.
     */
    public function index(Request $r): JsonResponse
    {
        abort_unless($r->user()?->role === 'admin', 403, 'Unauthorized access to clinic backups.');

        $files = File::glob($this->backupDir.DIRECTORY_SEPARATOR.'*.json');
        $backups = [];
        $totalBytes = 0;

        foreach ($files as $filePath) {
            $filename = basename($filePath);
            $bytes = (int) File::size($filePath);
            $totalBytes += $bytes;
            $meta = $this->readBackupMetadata($filePath);

            $backups[] = [
                'filename' => $filename,
                'file_size' => $this->formatBytes($bytes),
                'file_size_bytes' => $bytes,
                'created_at' => $meta['created_at'] ?? Carbon::createFromTimestamp(File::lastModified($filePath))->toIso8601String(),
                'created_at_formatted' => Carbon::parse($meta['created_at'] ?? File::lastModified($filePath))->format('M d, Y · g:i A'),
                'created_by' => $meta['created_by_name'] ?? 'Clinic Administrator',
                'notes' => $meta['notes'] ?? 'System Backup',
                'total_records' => $meta['total_records'] ?? 0,
                'record_counts' => $meta['record_counts'] ?? [],
                'is_safety_snapshot' => str_starts_with($filename, 'pre_restore_safety_'),
            ];
        }

        // Sort newest first
        usort($backups, function ($a, $b) {
            return strcmp($b['created_at'], $a['created_at']);
        });

        $systemStats = [
            'patients' => PatientRecord::count(),
            'appointments' => Appointment::count(),
            'clinical_sessions' => ClinicalSession::count(),
            'dental_chart_entries' => DentalChartEntry::count(),
            'transactions' => Transaction::count(),
            'prescriptions' => Prescription::count(),
            'services' => Service::count(),
            'users' => User::count(),
            'dentist_blocks' => DentistBlock::count(),
        ];
        $systemStats['total_records'] = array_sum($systemStats);

        return response()->json([
            'backups' => $backups,
            'total_backups' => count($backups),
            'total_storage_size' => $this->formatBytes($totalBytes),
            'latest_backup' => $backups[0] ?? null,
            'system_stats' => $systemStats,
        ]);
    }

    /**
     * Create a new backup copy of all patient and clinic records.
     */
    public function store(Request $r): JsonResponse
    {
        abort_unless($r->user()?->role === 'admin', 403, 'Unauthorized access to clinic backups.');

        $v = $r->validate([
            'notes' => 'nullable|string|max:255',
        ]);

        $backupData = $this->compileClinicData();
        $notes = ! empty($v['notes']) ? trim($v['notes']) : 'Manual Clinic Records Backup';

        $recordCounts = array_map(fn ($rows) => count($rows), $backupData);
        $totalRecords = array_sum($recordCounts);

        $timestamp = now();
        $filename = 'cerillo_backup_'.$timestamp->format('Y-m-d_H-i-s').'_'.substr(md5(uniqid('', true)), 0, 6).'.json';
        $fullPath = $this->backupDir.DIRECTORY_SEPARATOR.$filename;

        $payload = [
            'metadata' => [
                'app' => 'Cerillo Dental Clinic',
                'version' => '6.0',
                'format' => 'v6_clinical_archive',
                'created_at' => $timestamp->toIso8601String(),
                'created_by_id' => $r->user()->id,
                'created_by_name' => $r->user()->name,
                'created_by_email' => $r->user()->email,
                'notes' => $notes,
                'record_counts' => $recordCounts,
                'total_records' => $totalRecords,
            ],
            'data' => $backupData,
        ];

        File::put($fullPath, json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        $this->logActivity(
            actorId: $r->user()->id,
            action: 'backup_created',
            details: "Created clinic data backup '{$filename}' ({$totalRecords} records protected)."
        );

        return response()->json([
            'message' => 'Clinic data backup created successfully.',
            'filename' => $filename,
            'total_records' => $totalRecords,
            'record_counts' => $recordCounts,
            'created_at' => $timestamp->format('M d, Y · g:i A'),
        ], 201);
    }

    /**
     * Download a backup copy file.
     */
    public function download(Request $r, string $filename): BinaryFileResponse
    {
        abort_unless($r->user()?->role === 'admin', 403, 'Unauthorized access to clinic backups.');

        $cleanFilename = basename($filename);
        $fullPath = $this->backupDir.DIRECTORY_SEPARATOR.$cleanFilename;

        abort_unless(File::exists($fullPath) && str_ends_with($cleanFilename, '.json'), 404, 'Backup file not found.');

        return response()->download($fullPath, $cleanFilename, [
            'Content-Type' => 'application/json',
        ]);
    }

    /**
     * Restore patient and clinic records from an existing or uploaded backup file.
     */
    public function restore(Request $r): JsonResponse
    {
        abort_unless($r->user()?->role === 'admin', 403, 'Unauthorized access to clinic backups.');

        $v = $r->validate([
            'filename' => 'nullable|string',
            'backup_file' => 'nullable|file|mimes:json,txt|max:51200', // max 50MB
        ]);

        $payload = null;
        $sourceName = '';

        if ($r->hasFile('backup_file')) {
            $content = File::get($r->file('backup_file')->getRealPath());
            $payload = json_decode($content, true);
            $sourceName = $r->file('backup_file')->getClientOriginalName();
        } elseif (! empty($v['filename'])) {
            $clean = basename($v['filename']);
            $fullPath = $this->backupDir.DIRECTORY_SEPARATOR.$clean;
            abort_unless(File::exists($fullPath), 404, 'Selected backup file was not found.');
            $content = File::get($fullPath);
            $payload = json_decode($content, true);
            $sourceName = $clean;
        } else {
            return response()->json(['message' => 'Please provide a backup filename or upload a backup file.'], 422);
        }

        if (! is_array($payload) || ! isset($payload['data']) || ! is_array($payload['data'])) {
            return response()->json([
                'message' => 'Invalid backup format. The backup archive must contain clinical data records.',
            ], 422);
        }

        // Automatic Safety Step: Create pre-restore safety snapshot of the live database first
        $safetyFilename = 'pre_restore_safety_'.now()->format('Y-m-d_H-i-s').'_'.substr(md5(uniqid('', true)), 0, 6).'.json';
        $currentData = $this->compileClinicData();
        $safetyCounts = array_map(fn ($rows) => count($rows), $currentData);
        $safetyPayload = [
            'metadata' => [
                'app' => 'Cerillo Dental Clinic',
                'version' => '6.0',
                'format' => 'v6_clinical_archive',
                'created_at' => now()->toIso8601String(),
                'created_by_id' => $r->user()->id,
                'notes' => 'Automatic safety rollback snapshot',
                'target_restore_source' => $sourceName,
                'record_counts' => $safetyCounts,
                'total_records' => array_sum($safetyCounts),
            ],
            'data' => $currentData,
        ];
        File::put($this->backupDir.DIRECTORY_SEPARATOR.$safetyFilename, json_encode($safetyPayload, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        // Restoration execution in proper dependency order
        $tablesInOrder = [
            'users',
            'teeth',
            'services',
            'patient_records',
            'dentist_blocks',
            'appointments',
            'clinical_sessions',
            'dental_chart_entries',
            'patient_tooth_records',
            'treatment_records',
            'prescriptions',
            'transactions',
        ];

        $restoredCounts = [];

        DB::beginTransaction();
        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');

            // Delete existing rows in reverse dependency order
            foreach (array_reverse($tablesInOrder) as $table) {
                if (isset($payload['data'][$table])) {
                    DB::table($table)->delete();
                }
            }

            // Insert restored rows in dependency order
            foreach ($tablesInOrder as $table) {
                if (isset($payload['data'][$table]) && is_array($payload['data'][$table])) {
                    $rows = $payload['data'][$table];
                    if (! empty($rows)) {
                        foreach (array_chunk($rows, 100) as $chunk) {
                            $cleanChunk = array_map(fn ($item) => (array) $item, $chunk);
                            DB::table($table)->insert($cleanChunk);
                        }
                    }
                    $restoredCounts[$table] = count($rows);
                }
            }

            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            DB::commit();
        } catch (\Throwable $e) {
            if (DB::transactionLevel() > 0) {
                DB::rollBack();
            }
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            return response()->json([
                'message' => 'Restoration failed: '.$e->getMessage(),
            ], 500);
        }

        Cache::flush();

        $totalRestored = array_sum($restoredCounts);

        $this->logActivity(
            actorId: $r->user()->id,
            action: 'backup_restored',
            details: "Restored clinic records from '{$sourceName}' ({$totalRestored} records restored). Safety snapshot created: '{$safetyFilename}'."
        );

        return response()->json([
            'message' => 'Clinic data restored successfully.',
            'source' => $sourceName,
            'total_restored' => $totalRestored,
            'restored_counts' => $restoredCounts,
            'safety_snapshot' => $safetyFilename,
        ]);
    }

    /**
     * Delete an existing backup copy.
     */
    public function destroy(Request $r, string $filename): JsonResponse
    {
        abort_unless($r->user()?->role === 'admin', 403, 'Unauthorized access to clinic backups.');

        $clean = basename($filename);
        $fullPath = $this->backupDir.DIRECTORY_SEPARATOR.$clean;

        abort_unless(File::exists($fullPath) && str_ends_with($clean, '.json'), 404, 'Backup file not found.');

        File::delete($fullPath);

        $this->logActivity(
            actorId: $r->user()->id,
            action: 'backup_deleted',
            details: "Deleted clinic backup copy '{$clean}'."
        );

        return response()->json([
            'message' => 'Backup copy deleted successfully.',
            'filename' => $clean,
        ]);
    }

    /**
     * Compile live clinic data from database tables.
     */
    protected function compileClinicData(): array
    {
        return [
            'users' => DB::table('users')->get()->map(fn ($r) => (array) $r)->all(),
            'teeth' => DB::table('teeth')->get()->map(fn ($r) => (array) $r)->all(),
            'services' => DB::table('services')->get()->map(fn ($r) => (array) $r)->all(),
            'patient_records' => DB::table('patient_records')->get()->map(fn ($r) => (array) $r)->all(),
            'dentist_blocks' => DB::table('dentist_blocks')->get()->map(fn ($r) => (array) $r)->all(),
            'appointments' => DB::table('appointments')->get()->map(fn ($r) => (array) $r)->all(),
            'clinical_sessions' => DB::table('clinical_sessions')->get()->map(fn ($r) => (array) $r)->all(),
            'dental_chart_entries' => DB::table('dental_chart_entries')->get()->map(fn ($r) => (array) $r)->all(),
            'patient_tooth_records' => DB::table('patient_tooth_records')->get()->map(fn ($r) => (array) $r)->all(),
            'treatment_records' => DB::table('treatment_records')->get()->map(fn ($r) => (array) $r)->all(),
            'prescriptions' => DB::table('prescriptions')->get()->map(fn ($r) => (array) $r)->all(),
            'transactions' => DB::table('transactions')->get()->map(fn ($r) => (array) $r)->all(),
        ];
    }

    /**
     * Read the metadata block of a backup JSON file without loading all clinical rows if possible.
     */
    protected function readBackupMetadata(string $path): array
    {
        try {
            // Read first 4KB to extract metadata quickly
            $handle = fopen($path, 'r');
            if (! $handle) {
                return [];
            }
            $sample = fread($handle, 4096);
            fclose($handle);

            if (preg_match('/"metadata"\s*:\s*(\{.+?\})\s*,\s*"data"/s', $sample, $matches)) {
                $decoded = json_decode($matches[1], true);
                if (is_array($decoded)) {
                    return $decoded;
                }
            }

            // Fallback: decode whole file
            $all = json_decode(File::get($path), true);

            return $all['metadata'] ?? [];
        } catch (\Throwable $e) {
            return [];
        }
    }

    /**
     * Format raw byte count into human-readable string.
     */
    protected function formatBytes(int $bytes): string
    {
        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 1).' MB';
        }
        if ($bytes >= 1024) {
            return number_format($bytes / 1024, 1).' KB';
        }

        return $bytes.' B';
    }

    /**
     * Helper to log backup activity in audit_logs.
     */
    protected function logActivity(int $actorId, string $action, string $details): void
    {
        try {
            DB::table('audit_logs')->insert([
                'actor_id' => $actorId,
                'action' => $action,
                'subject_type' => 'Backup',
                'subject_id' => null,
                'details' => $details,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } catch (\Throwable $e) {
            // Ignore audit logging errors so backup operations proceed safely
        }
    }
}

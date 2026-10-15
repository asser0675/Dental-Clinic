<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class BackupRecoveryTest extends TestCase
{
    protected function tearDown(): void
    {
        // Clean up test backup files from storage
        $testFiles = File::glob(storage_path('app/backups/cerillo_backup_test_*.json'));
        foreach ($testFiles as $f) {
            @unlink($f);
        }

        parent::tearDown();
    }

    public function test_guests_cannot_access_backups(): void
    {
        $this->getJson('/api/backups')->assertStatus(401);
        $this->postJson('/api/backups')->assertStatus(401);
        $this->postJson('/api/backups/restore')->assertStatus(401);
    }

    public function test_non_admin_users_cannot_access_backups(): void
    {
        $dentist = User::where('role', 'dentist')->first();
        if ($dentist) {
            $this->actingAs($dentist)->getJson('/api/backups')->assertStatus(403);
            $this->actingAs($dentist)->postJson('/api/backups')->assertStatus(403);
            $this->actingAs($dentist)->postJson('/api/backups/restore')->assertStatus(403);
        }
    }

    public function test_admin_can_list_system_backups_and_stats(): void
    {
        $admin = User::where('role', 'admin')->first();
        $this->assertNotNull($admin, 'Admin user must exist');

        $response = $this->actingAs($admin)->getJson('/api/backups');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'backups',
                'total_backups',
                'total_storage_size',
                'system_stats' => [
                    'patients',
                    'appointments',
                    'clinical_sessions',
                    'dental_chart_entries',
                    'transactions',
                    'services',
                    'users',
                    'total_records',
                ],
            ]);
    }

    public function test_admin_can_create_backup_snapshot(): void
    {
        $admin = User::where('role', 'admin')->first();
        $this->assertNotNull($admin, 'Admin user must exist');

        $response = $this->actingAs($admin)->postJson('/api/backups', [
            'notes' => 'Automated Feature Test Snapshot',
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'message',
                'filename',
                'total_records',
                'record_counts',
                'created_at',
            ]);

        $filename = $response->json('filename');
        $this->assertNotEmpty($filename);
        $this->assertFileExists(storage_path('app/backups/'.$filename));

        // Test download
        $downloadRes = $this->actingAs($admin)->get('/api/backups/'.$filename.'/download');
        $downloadRes->assertStatus(200);

        // Test restore using filename
        $restoreRes = $this->actingAs($admin)->postJson('/api/backups/restore', [
            'filename' => $filename,
        ]);

        $restoreRes->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'source',
                'total_restored',
                'safety_snapshot',
            ]);

        $safetySnapshot = $restoreRes->json('safety_snapshot');
        $this->assertNotEmpty($safetySnapshot);
        $this->assertFileExists(storage_path('app/backups/'.$safetySnapshot));

        // Test delete
        $deleteRes = $this->actingAs($admin)->deleteJson('/api/backups/'.$filename);
        $deleteRes->assertStatus(200);
        $this->assertFileDoesNotExist(storage_path('app/backups/'.$filename));

        // Clean up safety snapshot
        if (File::exists(storage_path('app/backups/'.$safetySnapshot))) {
            @unlink(storage_path('app/backups/'.$safetySnapshot));
        }
    }
}

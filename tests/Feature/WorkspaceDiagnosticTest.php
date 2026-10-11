<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class WorkspaceDiagnosticTest extends TestCase
{
    public function test_admin_workspace_renders_successfully(): void
    {
        $admin = User::where('role', 'admin')->first();
        $this->assertNotNull($admin, 'Admin user should exist.');

        $start = microtime(true);
        $response = $this->actingAs($admin)->get('/workspace');
        $duration = microtime(true) - $start;

        $response->assertStatus(200);
        $this->assertLessThan(5.0, $duration, 'Admin workspace took too long to render');
    }

    public function test_dentist_workspace_renders_successfully(): void
    {
        $dentist = User::where('role', 'dentist')->first();
        $this->assertNotNull($dentist, 'Dentist user should exist.');

        $start = microtime(true);
        $response = $this->actingAs($dentist)->get('/workspace');
        $duration = microtime(true) - $start;

        $response->assertStatus(200);
        $this->assertLessThan(5.0, $duration, 'Dentist workspace took too long to render');
    }

    public function test_dentist_operations_renders_successfully(): void
    {
        $dentist = User::where('role', 'dentist')->first();
        $this->assertNotNull($dentist, 'Dentist user should exist.');

        $start = microtime(true);
        $response = $this->actingAs($dentist)->get('/operations');
        $duration = microtime(true) - $start;

        $response->assertStatus(200);
        $this->assertLessThan(5.0, $duration, 'Dentist operations took too long to render');
    }

    public function test_api_endpoints_respond_for_admin_and_dentist(): void
    {
        $admin = User::where('role', 'admin')->first();
        $dentist = User::where('role', 'dentist')->first();

        $this->actingAs($admin)->getJson('/api/dashboard')->assertStatus(200);
        $this->actingAs($dentist)->getJson('/api/dashboard')->assertStatus(200);

        $this->actingAs($admin)->getJson('/api/appointments')->assertStatus(200);
        $this->actingAs($dentist)->getJson('/api/appointments')->assertStatus(200);

        $this->actingAs($admin)->getJson('/api/patients')->assertStatus(200);
        $this->actingAs($dentist)->getJson('/api/patients')->assertStatus(200);
    }
}

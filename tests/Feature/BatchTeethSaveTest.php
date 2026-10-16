<?php

namespace Tests\Feature;

use App\Models\Appointment;
use App\Models\PatientRecord;
use App\Models\Service;
use App\Models\Tooth;
use App\Models\User;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class BatchTeethSaveTest extends TestCase
{
    public function test_batch_saving_appointment_teeth_in_single_request(): void
    {
        $dentist = User::where('role', 'dentist')->first();
        $this->assertNotNull($dentist);

        $patient = PatientRecord::firstOrCreate(
            ['phone' => '09123456789'],
            [
                'patient_code' => PatientRecord::nextPatientCode(),
                'name' => 'Batch Test Patient',
                'email' => 'batchtest@example.com',
            ]
        );

        $service = Service::where('active', true)->first();
        $appointment = Appointment::create([
            'patient_id' => $patient->id,
            'dentist_id' => $dentist->id,
            'service_id' => $service?->id,
            'starts_at' => Carbon::today()->setTime(9, 0, 0),
            'ends_at' => Carbon::today()->setTime(10, 0, 0),
            'status' => 'In Progress',
            'source' => 'staff',
            'guest_name' => $patient->name,
            'guest_phone' => $patient->phone,
        ]);

        $tooth18 = Tooth::where('fdi_number', 18)->first();
        $tooth11 = Tooth::where('fdi_number', 11)->first();

        $response = $this->actingAs($dentist)->postJson("/api/appointments/{$appointment->id}/teeth/batch", [
            'teeth' => [
                [
                    'tooth_id' => $tooth18?->id,
                    'tooth_fdi' => 18,
                    'condition' => 'Decay / Caries',
                    'surfaces' => ['O', 'D'],
                    'notes' => 'Occlusal cavity',
                ],
                [
                    'tooth_id' => $tooth11?->id,
                    'tooth_fdi' => 11,
                    'condition' => 'Filling / Restoration',
                    'surfaces' => ['M'],
                    'notes' => 'Existing composite',
                ],
            ],
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'count' => 2,
        ]);

        $this->assertDatabaseHas('patient_tooth_records', [
            'patient_id' => $patient->id,
            'tooth_id' => $tooth18?->id,
            'condition' => 'Decay / Caries',
        ]);

        $this->assertDatabaseHas('patient_tooth_records', [
            'patient_id' => $patient->id,
            'tooth_id' => $tooth11?->id,
            'condition' => 'Filling / Restoration',
        ]);
    }
}


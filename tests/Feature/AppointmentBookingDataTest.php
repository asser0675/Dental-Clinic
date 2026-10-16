<?php

namespace Tests\Feature;

use App\Models\Appointment;
use App\Models\PatientRecord;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class AppointmentBookingDataTest extends TestCase
{
    public function test_booking_appointment_for_existing_patient_reflects_real_data(): void
    {
        $frontDesk = User::where('role', 'front_desk')->first();
        $this->assertNotNull($frontDesk);

        $dentist = User::where('role', 'dentist')->first();
        $this->assertNotNull($dentist);

        $service = Service::where('active', true)->first();
        $this->assertNotNull($service);

        // Create or get a patient record with specific email and DOB
        $patient = PatientRecord::create([
            'patient_code' => PatientRecord::nextPatientCode(),
            'name' => 'Test Real Patient',
            'phone' => '9991234567',
            'email' => 'realpatient@example.com',
            'date_of_birth' => '1992-08-14',
            'gender' => 'Female',
        ]);

        $futureStart = Carbon::now()->addDays(2)->setTime(10, 0, 0)->format('Y-m-d H:i:s');

        $response = $this->actingAs($frontDesk)->postJson('/api/appointments', [
            'guest_name' => $patient->name,
            'guest_phone' => '9991234567',
            'guest_email' => null, // Left null to ensure it falls back to real patient email
            'dentist_id' => $dentist->id,
            'service_id' => $service->id,
            'starts_at' => $futureStart,
            'source' => 'walk_in',
            'patient_id' => $patient->id,
            'intake_details' => [
                'allergies' => 'Penicillin allergy',
                'concern' => 'Tooth sensitivity',
            ],
        ]);

        $response->assertStatus(201);
        $appointmentId = $response->json('id');
        $this->assertNotNull($appointmentId);

        $appt = Appointment::find($appointmentId);
        $this->assertEquals($patient->id, $appt->patient_id);
        $this->assertEquals('realpatient@example.com', $appt->guest_email);
        $this->assertEquals('Test Real Patient', $appt->guest_name);
        $this->assertEquals('9991234567', $appt->guest_phone);
        $this->assertEquals($futureStart, $appt->starts_at->format('Y-m-d H:i:s'));
        $this->assertEquals('1992-08-14', $appt->intake_details['date_of_birth']);
        $this->assertEquals('Penicillin allergy', $appt->intake_details['allergies']);

        // Clean up
        $appt->delete();
        $patient->delete();
    }

    public function test_booking_appointment_for_new_patient_saves_real_email_and_date(): void
    {
        $frontDesk = User::where('role', 'front_desk')->first();
        $dentist = User::where('role', 'dentist')->first();
        $service = Service::where('active', true)->first();

        $futureStart = Carbon::now()->addDays(3)->setTime(14, 30, 0)->format('Y-m-d H:i:s');

        $response = $this->actingAs($frontDesk)->postJson('/api/appointments', [
            'guest_name' => 'Maria Santos',
            'guest_phone' => '9187654321',
            'guest_email' => 'mariasantos@example.com',
            'dentist_id' => $dentist->id,
            'service_id' => $service->id,
            'starts_at' => $futureStart,
            'source' => 'walk_in',
            'intake_details' => [
                'date_of_birth' => '1998-04-20',
                'sex' => 'Female',
                'address' => 'Davao City',
                'allergies' => 'Latex',
                'concern' => 'Routine checkup',
            ],
        ]);

        $response->assertStatus(201);
        $appointmentId = $response->json('id');

        $appt = Appointment::find($appointmentId);
        $this->assertEquals('Maria Santos', $appt->guest_name);
        $this->assertEquals('mariasantos@example.com', $appt->guest_email);
        $this->assertEquals('9187654321', $appt->guest_phone);
        $this->assertEquals($futureStart, $appt->starts_at->format('Y-m-d H:i:s'));
        $this->assertEquals('1998-04-20', $appt->intake_details['date_of_birth']);
        $this->assertEquals('Latex', $appt->intake_details['allergies']);

        // Clean up
        $appt->delete();
    }
}

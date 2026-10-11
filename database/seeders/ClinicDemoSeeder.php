<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\ClinicalSession;
use App\Models\DentalChartEntry;
use App\Models\PatientRecord;
use App\Models\PatientToothRecord;
use App\Models\Service;
use App\Models\Tooth;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ClinicDemoSeeder extends Seeder
{
    /**
     * Seed a small, repeatable clinic data set so a fresh installation is not empty.
     * Existing user-created records are not deleted or replaced.
     */
    public function run(): void
    {
        $dentist = User::query()->where('role', 'dentist')->orderBy('id')->first();
        if (! $dentist) {
            return;
        }

        $services = Service::query()->get()->keyBy('name');

        $patients = [
            [
                'name' => 'Maria Santos',
                'email' => 'maria.santos@example.com',
                'phone' => '9172345601',
                'date_of_birth' => '1998-03-14',
                'gender' => 'Female',
                'address' => 'Bajada, Davao City',
                'concern' => 'Routine cleaning and gum sensitivity',
                'allergies' => 'None',
                'medications' => 'None',
                'medical_history' => 'No significant medical history',
            ],
            [
                'name' => 'John Carlo Reyes',
                'email' => 'john.reyes@example.com',
                'phone' => '9183456702',
                'date_of_birth' => '1994-11-02',
                'gender' => 'Male',
                'address' => 'Matina, Davao City',
                'concern' => 'Tooth sensitivity on upper right molar',
                'allergies' => 'Penicillin',
                'medications' => 'None',
                'medical_history' => 'Controlled asthma',
            ],
            [
                'name' => 'Angela Mae Lim',
                'email' => 'angela.lim@example.com',
                'phone' => '9194567803',
                'date_of_birth' => '2001-07-26',
                'gender' => 'Female',
                'address' => 'Lanang, Davao City',
                'concern' => 'Dental examination and preventive care',
                'allergies' => 'None',
                'medications' => 'None',
                'medical_history' => 'None reported',
            ],
            [
                'name' => 'Paolo Miguel Cruz',
                'email' => 'paolo.cruz@example.com',
                'phone' => '9205678904',
                'date_of_birth' => '1989-05-09',
                'gender' => 'Male',
                'address' => 'Toril, Davao City',
                'concern' => 'Pain on lower left tooth',
                'allergies' => 'None',
                'medications' => 'Losartan',
                'medical_history' => 'Hypertension',
            ],
            [
                'name' => 'Sofia Andrea Garcia',
                'email' => 'sofia.garcia@example.com',
                'phone' => '9216789005',
                'date_of_birth' => '2004-01-18',
                'gender' => 'Female',
                'address' => 'Ecoland, Davao City',
                'concern' => 'Check discoloration and oral hygiene',
                'allergies' => 'None',
                'medications' => 'None',
                'medical_history' => 'None reported',
            ],
            [
                'name' => 'Rafael Domingo',
                'email' => 'rafael.domingo@example.com',
                'phone' => '9227890106',
                'date_of_birth' => '1978-09-30',
                'gender' => 'Male',
                'address' => 'Agdao, Davao City',
                'concern' => 'Missing tooth consultation',
                'allergies' => 'None',
                'medications' => 'Metformin',
                'medical_history' => 'Type 2 diabetes, controlled',
            ],
        ];

        $patientModels = [];
        foreach ($patients as $data) {
            $patient = PatientRecord::query()->where('email', $data['email'])->first();
            if (! $patient) {
                $patient = PatientRecord::create([
                    'patient_code' => PatientRecord::nextPatientCode(),
                    'name' => $data['name'],
                    'date_of_birth' => $data['date_of_birth'],
                    'gender' => $data['gender'],
                    'phone' => $data['phone'],
                    'email' => $data['email'],
                ]);
            } else {
                $patient->update([
                    'name' => $data['name'],
                    'date_of_birth' => $data['date_of_birth'],
                    'gender' => $data['gender'],
                    'phone' => $data['phone'],
                ]);
            }
            $patientModels[$data['email']] = $patient;
        }

        $appointmentRows = [
            ['email' => 'maria.santos@example.com', 'service' => 'Oral Prophylaxis', 'start' => '2026-09-15 09:00:00', 'status' => 'Completed', 'source' => 'staff'],
            ['email' => 'john.reyes@example.com', 'service' => 'Composite Restoration', 'start' => '2026-09-22 10:30:00', 'status' => 'Completed', 'source' => 'walk_in'],
            ['email' => 'angela.lim@example.com', 'service' => 'Comprehensive Dental Examination', 'start' => '2026-10-02 13:00:00', 'status' => 'Completed', 'source' => 'online'],
            ['email' => 'paolo.cruz@example.com', 'service' => 'Tooth Extraction', 'start' => '2026-10-05 14:00:00', 'status' => 'Completed', 'source' => 'staff'],
            ['email' => 'sofia.garcia@example.com', 'service' => 'Oral Prophylaxis', 'start' => '2026-10-08 15:30:00', 'status' => 'Completed', 'source' => 'walk_in'],
            ['email' => 'rafael.domingo@example.com', 'service' => 'Comprehensive Dental Examination', 'start' => '2026-10-09 11:00:00', 'status' => 'Completed', 'source' => 'online'],
            ['email' => 'maria.santos@example.com', 'service' => 'Fluoride Treatment', 'start' => '2026-10-12 09:30:00', 'status' => 'Cancelled', 'source' => 'staff'],
            ['email' => 'john.reyes@example.com', 'service' => 'Comprehensive Dental Examination', 'start' => '2026-10-13 10:00:00', 'status' => 'Cancelled', 'source' => 'online'],
            ['email' => 'angela.lim@example.com', 'service' => 'Dental Sealants', 'start' => '2026-10-11 14:30:00', 'status' => 'Checked In', 'source' => 'walk_in'],
            ['email' => 'paolo.cruz@example.com', 'service' => 'Oral Prophylaxis', 'start' => '2026-10-10 16:00:00', 'status' => 'Cancelled', 'source' => 'staff'],
        ];

        $appointments = [];
        foreach ($appointmentRows as $row) {
            $patient = $patientModels[$row['email']];
            $service = $services->get($row['service']);
            if (! $service) {
                continue;
            }

            $startsAt = Carbon::parse($row['start']);
            $endsAt = (clone $startsAt)->addMinutes((int) ($service->duration_minutes ?: 45));
            $patientSeed = collect($patients)->firstWhere('email', $row['email']);

            $appointment = Appointment::updateOrCreate(
                [
                    'guest_email' => $row['email'],
                    'starts_at' => $startsAt,
                ],
                [
                    'patient_id' => $patient->id,
                    'dentist_id' => $dentist->id,
                    'service_id' => $service->id,
                    'guest_name' => $patient->name,
                    'guest_phone' => $patient->phone,
                    'ends_at' => $endsAt,
                    'source' => $row['source'],
                    'status' => $row['status'],
                    'verified_at' => $startsAt->copy()->subDay(),
                    'checked_in_at' => $row['status'] === 'Checked In' ? $startsAt->copy()->subMinutes(10) : null,
                    'cancelled_at' => $row['status'] === 'Cancelled' ? $startsAt->copy()->subHours(3) : null,
                    'cancellation_reason' => $row['status'] === 'Cancelled' ? 'Patient requested reschedule.' : null,
                    'intake_details' => [
                        'address' => $patientSeed['address'] ?? null,
                        'concern' => $patientSeed['concern'] ?? null,
                        'allergies' => $patientSeed['allergies'] ?? null,
                        'medications' => $patientSeed['medications'] ?? null,
                        'medical_history' => $patientSeed['medical_history'] ?? null,
                        'contact_preference' => 'SMS',
                        'date_of_birth' => $patientSeed['date_of_birth'] ?? null,
                        'gender' => $patientSeed['gender'] ?? null,
                    ],
                ]
            );

            $appointments[] = $appointment;

            if ($row['status'] === 'Completed') {
                $session = ClinicalSession::updateOrCreate(
                    ['appointment_id' => $appointment->id],
                    [
                        'patient_id' => $patient->id,
                        'dentist_id' => $dentist->id,
                        'clinical_findings' => ['Oral tissues assessed', 'Treatment completed as planned'],
                        'diagnosis' => $patientSeed['concern'] ?? 'Routine dental assessment',
                        'treatment_recommendations' => 'Maintain oral hygiene and return for scheduled recall.',
                        'dentist_notes' => 'Sample clinic record created during initial database setup.',
                        'finalized_at' => $endsAt,
                    ]
                );

                // Give the sample patient record a real dental-chart history without overwriting later user changes.
                $tooth = Tooth::query()->where('fdi_number', '16')->first();
                if ($tooth && ! DentalChartEntry::query()->where('clinical_session_id', $session->id)->exists()) {
                    DentalChartEntry::create([
                        'clinical_session_id' => $session->id,
                        'patient_id' => $patient->id,
                        'tooth_id' => $tooth->id,
                        'dentist_id' => $dentist->id,
                        'condition' => 'Sound',
                        'surfaces' => [],
                        'notes' => 'Baseline chart entry from initial clinic seed data.',
                    ]);
                    PatientToothRecord::firstOrCreate(
                        ['patient_id' => $patient->id, 'tooth_id' => $tooth->id],
                        [
                            'condition' => 'Sound',
                            'surface_conditions' => [],
                            'notes' => 'Baseline chart entry from initial clinic seed data.',
                            'last_updated_by' => $dentist->id,
                        ]
                    );
                }
            }
        }
    }
}

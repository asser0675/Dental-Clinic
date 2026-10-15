<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\ClinicalSession;
use App\Models\PatientRecord;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class CerilloRequestedDataSeeder extends Seeder
{
    /**
     * Adds the requested Cerillo admin account and a repeatable set of
     * sample appointment rows without deleting existing clinic data.
     *
     * Appointment seed statuses are intentionally limited to:
     * Checked In, Cancelled, and Completed.
     */
    public function run(): void
    {
        $this->seedRequestedAdmin();

        $dentist = User::query()->where('role', 'dentist')->orderBy('id')->first();

        if (! $dentist) {
            $dentist = User::updateOrCreate(
                ['email' => 'dentist@cerillodental.com'],
                [
                    'name' => 'Dr. Angela Cerillo',
                    'password' => Hash::make('Dentist@2026'),
                    'role' => 'dentist',
                    'status' => 'Active',
                ]
            );
        }

        $services = $this->ensureServices();
        $patients = $this->ensureSamplePatients();

        if ($services->isEmpty() || empty($patients)) {
            return;
        }

        $this->seedAppointments($dentist, $services, $patients);
    }

    private function seedRequestedAdmin(): void
    {
        $requestedEmail = 'drml@admin.cerillo.com';

        $admin = User::query()->where('email', $requestedEmail)->first();

        // Reuse the original seeded Admin row when possible instead of leaving
        // two default Admin accounts in the database.
        if (! $admin) {
            $admin = User::query()->where('email', 'admin@cerillodental.com')->first();
        }

        if (! $admin) {
            $admin = new User;
        }

        $admin->fill([
            'name' => 'Dr. Maria Lourdes Cerillo-Bautista',
            'email' => $requestedEmail,
            'password' => Hash::make('Admin1234'),
            'role' => 'admin',
            'status' => 'Active',
        ]);
        $admin->save();
    }

    private function ensureServices()
    {
        $serviceRows = [
            ['name' => 'Comprehensive Dental Examination', 'price' => 800, 'duration_minutes' => 45],
            ['name' => 'Oral Prophylaxis', 'price' => 1200, 'duration_minutes' => 60],
            ['name' => 'Fluoride Treatment', 'price' => 600, 'duration_minutes' => 30],
            ['name' => 'Dental Sealants', 'price' => 900, 'duration_minutes' => 45],
            ['name' => 'Composite Restoration', 'price' => 2500, 'duration_minutes' => 75],
            ['name' => 'Tooth Extraction', 'price' => 2500, 'duration_minutes' => 60],
            ['name' => 'Root Canal Treatment', 'price' => 15000, 'duration_minutes' => 120],
            ['name' => 'Teeth Whitening', 'price' => 12000, 'duration_minutes' => 90],
        ];

        foreach ($serviceRows as $service) {
            Service::updateOrCreate(
                ['name' => $service['name']],
                [...$service, 'active' => true]
            );
        }

        return Service::query()
            ->whereIn('name', array_column($serviceRows, 'name'))
            ->orderBy('id')
            ->get();
    }

    private function ensureSamplePatients(): array
    {
        $rows = [
            ['name' => 'Maria Santos', 'email' => 'maria.santos@example.com', 'phone' => '9172345601', 'date_of_birth' => '1998-03-14', 'gender' => 'Female'],
            ['name' => 'John Carlo Reyes', 'email' => 'john.reyes@example.com', 'phone' => '9183456702', 'date_of_birth' => '1994-11-02', 'gender' => 'Male'],
            ['name' => 'Angela Mae Lim', 'email' => 'angela.lim@example.com', 'phone' => '9194567803', 'date_of_birth' => '2001-07-26', 'gender' => 'Female'],
            ['name' => 'Paolo Miguel Cruz', 'email' => 'paolo.cruz@example.com', 'phone' => '9205678904', 'date_of_birth' => '1989-05-09', 'gender' => 'Male'],
            ['name' => 'Sofia Andrea Garcia', 'email' => 'sofia.garcia@example.com', 'phone' => '9216789005', 'date_of_birth' => '2004-01-18', 'gender' => 'Female'],
            ['name' => 'Rafael Domingo', 'email' => 'rafael.domingo@example.com', 'phone' => '9227890106', 'date_of_birth' => '1978-09-30', 'gender' => 'Male'],
        ];

        $patients = [];

        foreach ($rows as $row) {
            $patient = PatientRecord::query()->where('email', $row['email'])->first();

            if (! $patient) {
                $patient = PatientRecord::create([
                    'patient_code' => PatientRecord::nextPatientCode(),
                    'name' => $row['name'],
                    'date_of_birth' => $row['date_of_birth'],
                    'gender' => $row['gender'],
                    'phone' => $row['phone'],
                    'email' => $row['email'],
                ]);
            } else {
                $patient->update([
                    'name' => $row['name'],
                    'date_of_birth' => $row['date_of_birth'],
                    'gender' => $row['gender'],
                    'phone' => $row['phone'],
                ]);
            }

            $patients[] = $patient;
        }

        return $patients;
    }

    private function seedAppointments(User $dentist, $services, array $patients): void
    {
        // Deterministic shuffle: the data looks varied, but running the patch
        // again updates the same sample appointments instead of endlessly adding more.
        mt_srand(20261011);

        $statuses = array_merge(
            array_fill(0, 12, 'Completed'),
            array_fill(0, 12, 'Cancelled'),
            array_fill(0, 6, 'Checked In')
        );
        shuffle($statuses);

        $completedIndex = 0;
        $cancelledIndex = 0;
        $checkedInIndex = 0;

        foreach ($statuses as $index => $status) {
            $patient = $patients[array_rand($patients)];
            $service = $services[random_int(0, $services->count() - 1)];

            if ($status === 'Completed') {
                $startsAt = Carbon::create(2026, 9, 5, 8, 30)
                    ->addDays($completedIndex * 2)
                    ->addMinutes(($completedIndex % 3) * 30);
                $completedIndex++;
            } elseif ($status === 'Cancelled') {
                $startsAt = Carbon::create(2026, 9, 12, 10, 0)
                    ->addDays($cancelledIndex * 2)
                    ->addMinutes(($cancelledIndex % 4) * 30);
                $cancelledIndex++;
            } else {
                // Checked-in samples are grouped on the current demo clinic day.
                $startsAt = Carbon::create(2026, 10, 11, 8, 0)
                    ->addHours($checkedInIndex * 2);
                $checkedInIndex++;
            }

            $endsAt = $startsAt->copy()->addMinutes((int) ($service->duration_minutes ?: 45));

            $appointment = Appointment::updateOrCreate(
                [
                    // This pair is stable across reruns and does not collide with
                    // normal user-created appointments unless the same demo patient
                    // is booked at the exact seeded time.
                    'guest_email' => $patient->email,
                    'starts_at' => $startsAt,
                ],
                [
                    'patient_id' => $patient->id,
                    'dentist_id' => $dentist->id,
                    'service_id' => $service->id,
                    'guest_name' => $patient->name,
                    'guest_phone' => $patient->phone,
                    'ends_at' => $endsAt,
                    'source' => ['online', 'walk_in', 'staff'][mt_rand(0, 2)],
                    'status' => $status,
                    'verified_at' => $startsAt->copy()->subDay(),
                    'checked_in_at' => $status === 'Checked In'
                        ? $startsAt->copy()->subMinutes(10)
                        : null,
                    'cancelled_at' => $status === 'Cancelled'
                        ? $startsAt->copy()->subHours(mt_rand(2, 24))
                        : null,
                    'cancellation_reason' => $status === 'Cancelled'
                        ? ['Patient requested cancellation.', 'Schedule conflict.', 'Patient requested reschedule.'][mt_rand(0, 2)]
                        : null,
                    'intake_details' => [
                        'contact_preference' => ['SMS', 'Email', 'Call'][mt_rand(0, 2)],
                        'concern' => ['Routine check-up', 'Tooth sensitivity', 'Cleaning', 'Dental pain', 'Follow-up consultation'][mt_rand(0, 4)],
                        'allergies' => mt_rand(0, 4) === 0 ? 'Penicillin' : 'None',
                        'medications' => 'None',
                    ],
                ]
            );

            if ($status === 'Completed') {
                ClinicalSession::updateOrCreate(
                    ['appointment_id' => $appointment->id],
                    [
                        'patient_id' => $patient->id,
                        'dentist_id' => $dentist->id,
                        'clinical_findings' => ['Oral examination completed', 'Treatment completed as planned'],
                        'diagnosis' => 'Sample completed dental visit',
                        'treatment_recommendations' => 'Maintain oral hygiene and return for regular recall.',
                        'dentist_notes' => 'Seeded sample clinical session.',
                        'finalized_at' => $endsAt,
                    ]
                );
            }
        }

        // If the earlier ClinicDemoSeeder patch was already used, its two
        // non-approved demo statuses are normalized without touching unrelated rows.
        Appointment::query()
            ->whereIn('guest_email', array_map(fn ($patient) => $patient->email, $patients))
            ->whereIn('starts_at', [
                '2026-10-12 09:30:00',
                '2026-10-13 10:00:00',
            ])
            ->whereNotIn('status', ['Checked In', 'Cancelled', 'Completed'])
            ->update([
                'status' => 'Cancelled',
                'checked_in_at' => null,
                'cancelled_at' => now(),
                'cancellation_reason' => 'Seed data normalized to the approved appointment statuses.',
            ]);
    }
}

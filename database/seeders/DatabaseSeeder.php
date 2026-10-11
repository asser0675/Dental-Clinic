<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $accounts = [
            ['name' => 'Super Admin', 'email' => 'superadmin@cerillodental.com', 'password' => 'Cerillo@2026', 'role' => 'super_admin'],
            ['name' => 'Dr. Maria Lourdes Cerillo-Bautista', 'email' => 'drml@admin.cerillo.com', 'password' => 'Admin1234', 'role' => 'admin'],
            ['name' => 'Dr. Angela Cerillo', 'email' => 'dentist@cerillodental.com', 'password' => 'Dentist@2026', 'role' => 'dentist'],
            ['name' => 'Front Desk', 'email' => 'frontdesk@cerillodental.com', 'password' => 'FrontDesk@2026', 'role' => 'front_desk'],
        ];

        foreach ($accounts as $account) {
            User::updateOrCreate(
                ['email' => $account['email']],
                [...$account, 'password' => Hash::make($account['password'])]
            );
        }

        $services = [
            ['name' => 'Comprehensive Dental Examination', 'price' => 800, 'duration_minutes' => 45],
            ['name' => 'Oral Prophylaxis', 'price' => 1200, 'duration_minutes' => 60],
            ['name' => 'Fluoride Treatment', 'price' => 600, 'duration_minutes' => 30],
            ['name' => 'Dental Sealants', 'price' => 900, 'duration_minutes' => 45],
            ['name' => 'Composite Restoration', 'price' => 2500, 'duration_minutes' => 75],
            ['name' => 'Dental Crown', 'price' => 18000, 'duration_minutes' => 120],
            ['name' => 'Dental Bridge', 'price' => 30000, 'duration_minutes' => 150],
            ['name' => 'Root Canal Treatment', 'price' => 15000, 'duration_minutes' => 120],
            ['name' => 'Tooth Extraction', 'price' => 2500, 'duration_minutes' => 60],
            ['name' => 'Wisdom Tooth Assessment', 'price' => 1500, 'duration_minutes' => 45],
            ['name' => 'Complete & Partial Dentures', 'price' => 25000, 'duration_minutes' => 120],
            ['name' => 'Dental Implant Restoration', 'price' => 45000, 'duration_minutes' => 90],
            ['name' => 'Teeth Whitening', 'price' => 12000, 'duration_minutes' => 90],
            ['name' => 'Porcelain Veneers', 'price' => 25000, 'duration_minutes' => 120],
            ['name' => 'Clear Aligners', 'price' => 85000, 'duration_minutes' => 60],
            ['name' => 'Orthodontic Braces', 'price' => 70000, 'duration_minutes' => 60],
            ['name' => 'Retainers', 'price' => 5000, 'duration_minutes' => 45],
            ['name' => 'Night Guard', 'price' => 5000, 'duration_minutes' => 45],
            ['name' => 'Periodontal Therapy', 'price' => 5000, 'duration_minutes' => 90],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(['name' => $service['name']], [...$service, 'active' => true]);
        }

        $this->call(ClinicDemoSeeder::class);
        $this->call(CerilloRequestedDataSeeder::class);
    }
}

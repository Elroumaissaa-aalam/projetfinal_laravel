<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        User::updateOrCreate(
            ['email' => 'admin@clinic.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'phone' => '+1-555-0001',
                'date_of_birth' => '1980-01-01',
                'gender' => 'male',
            ]
        );

        // Create Doctor Users
        User::updateOrCreate(
            ['email' => 'doctor@clinic.com'],
            [
                'name' => 'Dr. Sarah Johnson',
                'password' => Hash::make('password'),
                'role' => 'doctor',
                'phone' => '+1-555-0002',
                'date_of_birth' => '1975-03-15',
                'gender' => 'female',
                'specialization' => 'Cardiology',
                'license_number' => 'MD-12345',
            ]
        );

        User::updateOrCreate(
            ['email' => 'doctor2@clinic.com'],
            [
                'name' => 'Dr. Michael Chen',
                'password' => Hash::make('password'),
                'role' => 'doctor',
                'phone' => '+1-555-0003',
                'date_of_birth' => '1978-07-22',
                'gender' => 'male',
                'specialization' => 'General Medicine',
                'license_number' => 'MD-12346',
            ]
        );

        // Create Nurse Users
        User::updateOrCreate(
            ['email' => 'nurse@clinic.com'],
            [
                'name' => 'Nurse Emily Davis',
                'password' => Hash::make('password'),
                'role' => 'nurse',
                'phone' => '+1-555-0004',
                'date_of_birth' => '1985-11-08',
                'gender' => 'female',
                'license_number' => 'RN-56789',
            ]
        );

        User::updateOrCreate(
            ['email' => 'nurse2@clinic.com'],
            [
                'name' => 'Nurse Robert Wilson',
                'password' => Hash::make('password'),
                'role' => 'nurse',
                'phone' => '+1-555-0005',
                'date_of_birth' => '1982-09-12',
                'gender' => 'male',
                'license_number' => 'RN-56790',
            ]
        );

        // Create Patient Users
        User::updateOrCreate(
            ['email' => 'patient@clinic.com'],
            [
                'name' => 'John Smith',
                'password' => Hash::make('password'),
                'role' => 'patient',
                'phone' => '+1-555-0006',
                'date_of_birth' => '1990-05-20',
                'gender' => 'male',
                'address' => '123 Main St, Anytown, ST 12345',
            ]
        );

        User::updateOrCreate(
            ['email' => 'patient2@clinic.com'],
            [
                'name' => 'Mary Johnson',
                'password' => Hash::make('password'),
                'role' => 'patient',
                'phone' => '+1-555-0007',
                'date_of_birth' => '1988-12-03',
                'gender' => 'female',
                'address' => '456 Oak Ave, Somewhere, ST 67890',
            ]
        );

        User::updateOrCreate(
            ['email' => 'patient3@clinic.com'],
            [
                'name' => 'David Brown',
                'password' => Hash::make('password'),
                'role' => 'patient',
                'phone' => '+1-555-0008',
                'date_of_birth' => '1995-08-14',
                'gender' => 'male',
                'address' => '789 Pine Dr, Elsewhere, ST 54321',
            ]
        );

        // Create additional users for testing
        for ($i = 1; $i <= 10; $i++) {
            User::updateOrCreate(
                ['email' => "patient{$i}@example.com"],
                [
                    'name' => "Patient User {$i}",
                    'password' => Hash::make('password'),
                    'role' => 'patient',
                    'phone' => "+1-555-" . str_pad(1000 + $i, 4, '0', STR_PAD_LEFT),
                    'date_of_birth' => '1990-01-01',
                    'gender' => $i % 2 == 0 ? 'female' : 'male',
                    'address' => "{$i}00 Test St, Test City, ST 12345",
                ]
            );
        }
    }
}


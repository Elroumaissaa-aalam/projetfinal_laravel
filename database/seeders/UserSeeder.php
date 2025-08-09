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
            ['email' => 'patient@clinic.com'],
            [
                'name' => 'John Smith',
                'password' => Hash::make('password'),
                'phone' => '+1-555-0006',
                'date_of_birth' => '1990-05-20',
                'gender' => 'male',
                'address' => '123 Main St, Anytown, ST 12345',
               
            ]
        );
    }
}



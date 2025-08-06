<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Create roles
        $roles = ['patient', 'doctor', 'nurse', 'admin', 'pharmacist'];
        
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }
        
        // Assign roles to existing users based on their current role column
        User::all()->each(function ($user) {
            if ($user->role && !$user->hasRole($user->role)) {
                $user->assignRole($user->role);
            }
        });
    }
}
<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'date_of_birth',
        'gender',
        'address',
        'role',
        'specialization',
        'license_number',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'date_of_birth' => 'date',
        'password' => 'hashed',
    ];

    // Role checking methods
    public function isPatient() { return $this->role === 'patient'; }
    public function isDoctor() { return $this->role === 'doctor'; }
    public function isNurse() { return $this->role === 'nurse'; }
    public function isAdmin() { return $this->role === 'admin'; }
    public function isPharmacist() { return $this->role === 'pharmacist'; }
}



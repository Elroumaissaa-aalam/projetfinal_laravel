<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'specialty',
        'license_number',
        'experience',
        'phone',
        'address',
        'bio',
        'education',
        'work_start',
        'work_end',
        'working_days',
    ];

    protected $casts = [
        'experience' => 'integer',
    ];

    /**
     * Get the user that owns the doctor profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the appointments for the doctor.
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

  

}

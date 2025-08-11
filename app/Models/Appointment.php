<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'appointment_date',
        'duration_minutes',
        'type',
        'status',
        'notes',
        'diagnosis',
        'email_sent',
    ];

    protected function casts(): array
    {
        return [
            'appointment_date' => 'datetime',
            'email_sent' => 'boolean',
        ];
    }

  public function patient()
{
    return $this->belongsTo(User::class, 'patient_id');
}

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }



    

}

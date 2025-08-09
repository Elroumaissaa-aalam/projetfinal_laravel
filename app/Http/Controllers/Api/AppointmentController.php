<?php

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller {

    public function store(Request $request)
    {
        $appointment = Appointment::create([
            'patient_id' => auth(),
            'doctor_id' => $request->doctor_id,
            'appointment_date' => $request->start,
            'appointment_time' => $request->start,
            'duration_minutes' => $request->duration_minutes ?? 30,
            'status' => $request->status ?? 'scheduled',
            'type' => $request->type ?? 'consultation',
            'notes' => $request->notes
        ]);
    
        return response()->json([
            'id' => $appointment->id,
            'title' => $appointment->title,
            'start' => $appointment->appointment_date . 'T' . $appointment->appointment_time,
            'status' => $appointment->status,
            'type' => $appointment->type,
       
        ]);
    }
}

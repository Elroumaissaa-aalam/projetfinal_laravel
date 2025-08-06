<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Calendar API endpoints
Route::middleware('auth')->group(function () {
    Route::post('/appointments/book', function (Request $request) {
        $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'appointment_date' => 'required|date|after:today',
            'appointment_time' => 'required',
            'service_type' => 'required|string',
        ]);

        $appointment = \App\Models\Appointment::create([
            'patient_id' => auth()->id(),
            'doctor_id' => $request->doctor_id,
            'appointment_date' => $request->appointment_date . ' ' . $request->appointment_time,
            'type' => $request->service_type,
            'status' => 'scheduled',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Appointment booked successfully!',
            'appointment' => $appointment
        ]);
    });
    
    Route::get('/patient/appointments', function () {
        return response()->json([]);
    });
});

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\User;

class AppointmentController extends Controller
{
    public function calendar(Request $request)
    {
        // Get all doctors
        $doctors = User::where('role', 'doctor')->get()->map(function($doctor) {
            return [
                'id' => $doctor->id,
                'name' => $doctor->name,
                'specialization' => $doctor->specialization ?? 'General Practice'
            ];
        });

        // Get services
        $services = [
            ['id' => 'consultation', 'name' => 'Consultation', 'price' => 100],
            ['id' => 'checkup', 'name' => 'General Checkup', 'price' => 80],
            ['id' => 'follow_up', 'name' => 'Follow-up', 'price' => 60],
        ];

        $selectedDoctor = $request->get('doctor_id');
        $selectedDate = $request->get('date');
        $timeSlots = [];

        if ($selectedDoctor && $selectedDate) {
            $timeSlots = $this->generateTimeSlots();
        }

        return view('appointments.calendar', compact(
            'doctors', 
            'services', 
            'selectedDoctor', 
            'selectedDate', 
            'timeSlots'
        ));
    }

    public function book(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'appointment_date' => 'required|date|after:today',
            'appointment_time' => 'required',
        ]);

        $appointment = Appointment::create([
            'patient_id' => auth()->id(),
            'doctor_id' => $request->doctor_id,
            'appointment_date' => $request->appointment_date . ' ' . $request->appointment_time,
            'status' => 'scheduled',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Appointment booked successfully!',
            'appointment' => $appointment
        ]);
    }

    private function generateTimeSlots()
    {
        return [
            '09:00', '09:30', '10:00', '10:30', '11:00', '11:30',
            '14:00', '14:30', '15:00', '15:30', '16:00', '16:30'
        ];
    }
}



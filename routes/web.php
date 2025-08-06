<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PatientDashboardController;
use App\Http\Controllers\DoctorDashboardController;
use App\Http\Controllers\NurseDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PharmacyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/pharmacy', [PharmacyController::class, 'index'])->name('pharmacy');

Route::post('/appointments/book', [AppointmentController::class, 'book'])->name('appointments.book');
Route::get('/appointments/payment/{appointment}', [AppointmentController::class, 'payment'])->name('appointments.payment');
Route::post('/appointments/payment/process', [AppointmentController::class, 'processPayment'])->name('appointments.payment.process');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Dashboard routes
    Route::get('/dashboard', function () {
        $user = auth()->user();
        return match($user->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'doctor' => redirect()->route('doctor.dashboard'),
            'nurse' => redirect()->route('nurse.dashboard'),
            default => redirect()->route('patient.dashboard'),
        };
    })->name('dashboard');
    
    Route::get('/patient/dashboard', [PatientDashboardController::class, 'index'])->name('patient.dashboard');
    Route::get('/doctor/dashboard', [DoctorDashboardController::class, 'index'])->name('doctor.dashboard');
    Route::get('/nurse/dashboard', [NurseDashboardController::class, 'index'])->name('nurse.dashboard');
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});

require __DIR__.'/auth.php';






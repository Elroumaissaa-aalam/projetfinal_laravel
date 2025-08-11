<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PatientDashboardController;
use App\Http\Controllers\DoctorDashboardController;
use App\Http\Controllers\NurseDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\PamantController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('welcome'))->name('welcome');
Route::get('/about', fn() => view('about'))->name('about');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/patient/dashboard', [PatientDashboardController::class, 'index'])
        ->middleware('role:patient')
        ->name('patient.dashboard');

    Route::get('/doctor/dashboard', [DoctorDashboardController::class, 'index'])
        ->middleware('role:doctor')
        ->name('doctor.dashboard');

    Route::get('/nurse/dashboard', [NurseDashboardController::class, 'index'])
        ->middleware('role:nurse')
        ->name('nurse.dashboard');

    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
        ->middleware('role:admin')
        ->name('admin.dashboard');


    Route::get('/dashboard', function () {
        $user = Auth::user();
        return match (strtolower($user->role)) {
            'admin' => redirect()->route('admin.dashboard'),
            'doctor' => redirect()->route('doctor.dashboard'),
            'nurse' => redirect()->route('nurse.dashboard'),
            'patient' => redirect()->route('patient.dashboard'),
            default => abort(403, 'Access Denied'),
        };
    })->name('dashboard');

    Route::get('/stripe', [PamantController::class, 'checkout'])->name('stripe.payement');



    Route::get('/doctor', function () {
        return redirect()->route('doctor.dashboard');
    })->middleware('role:doctor')->name('doctor.redirect');

    Route::get('/nurse', function () {
        return redirect()->route('nurse.dashboard');
    })->middleware('role:nurse')->name('nurse.redirect');

    Route::get('/patient', function () {
        return redirect()->route('patient.dashboard');
    })->middleware('role:patient')->name('patient.redirect');

    Route::get('/admin', function () {
        return redirect()->route('admin.dashboard');
    })->middleware('role:admin')->name('admin.redirect');
});




require __DIR__ . '/auth.php';


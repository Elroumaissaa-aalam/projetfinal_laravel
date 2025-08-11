Route::middleware('auth:sanctum')->group(function () {
    Route::get('/appointments', [Api\AppointmentController::class, 'index']);
    Route::post('/appointments/book', [Api\AppointmentController::class, 'store']);
    Route::get('/appointments/available-times', [Api\AppointmentController::class, 'availableTimes']);
    Route::get('/doctors', [Api\AppointmentController::class, 'doctors']);
    Route::get('/patient/appointments', [Api\AppointmentController::class, 'patientAppointments']);
});
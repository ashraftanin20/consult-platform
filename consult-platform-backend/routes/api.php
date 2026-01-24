<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Professional\AvailabilityController;
use App\Http\Controllers\Api\Client\AppointmentController as ClientAppointmentController;
use App\Http\Controllers\Api\Professional\AppointmentController as ProfessionalAppointmentController;
use App\Controllers\Api\Professional\ConsultationHistoryController as ProfessionalConsulationHistory;
use App\Controllers\Api\ConsultationHistoryController;
use App\Controllers\Api\MessageController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum', 'role:professional'])->group(function () {
    Route::post('/professional/availability', [AvailabilityController::class, 'store']);

    Route::get('/professional/appointments/pending', [ProfessionalAppointmentController::class, 'pending']);
    Route::post('/professional/appointments/{id}/approve', [ProfessionalAppointmentController::class, 'approve']);
    Route::post('professional/appointments/{id}/cancel', [ProfessionalAppointmentController::class, 'cancel']);

    Route::post('/professional/appointments/{id}/history', [PreofessionalConsulationHisotry::class, 'store']);
});

Route::middleware(['auth:sanctum', 'role:client'])->group(function () {
    Route::get('/client/available-slots', [ClientAppointmentController::class, 'availableSlots']);
    Route::post('/client/request-appointment',[ClientAppointmentController::class, 'request']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class], 'me');

    Route::get('/appointment/{id}/history', [ConsultationHistoryController::class, 'show']);

    Route::post('/appointment/{id}/messages', [MessageController::class, 'send']);
    Route::get('/appointment/{id}/messages', [MessageController::class, 'conversation']);
    Route::post('/messages/{id}/read', [MessageController::class, 'markAsRead']);
});

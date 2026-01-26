<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Professional\AvailabilityController;
use App\Http\Controllers\Api\Client\AppointmentController as ClientAppointmentController;
use App\Http\Controllers\Api\Professional\AppointmentController as ProfessionalAppointmentController;
use App\Http\Controllers\Api\Professional\ConsultationHistoryController as ProfessionalConsultationHistory;
use App\Http\Controllers\Api\ConsultationHistoryController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\Professional\PrescriptionController as ProfessionalPrescriptionController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\Admin\AppointmentController as AdminAppointmentController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum', 'role:professional'])->group(function () {
    Route::post('/professional/availability', [AvailabilityController::class, 'store']);

    Route::get('/professional/appointments/pending', [ProfessionalAppointmentController::class, 'pending']);
    Route::post('/professional/appointments/{id}/approve', [ProfessionalAppointmentController::class, 'approve']);
    Route::post('professional/appointments/{id}/cancel', [ProfessionalAppointmentController::class, 'cancel']);

    Route::post('/professional/appointments/{id}/history', [ProfessionalConsultationHistory::class, 'store']);

    Route::post('/professional/appointments/{id}/prescription', [ProfessionalPrescriptionController::class, 'store']);
});

Route::middleware(['auth:sanctum', 'role:client'])->group(function () {
    Route::get('/client/available-slots', [ClientAppointmentController::class, 'availableSlots']);
    Route::post('/client/request-appointment',[ClientAppointmentController::class, 'request']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class], 'me');

    Route::get('/appointments/{id}/history', [ConsultationHistoryController::class, 'show']);

    Route::post('/appointments/{id}/messages', [MessageController::class, 'send']);
    Route::get('/appointments/{id}/messages', [MessageController::class, 'conversation']);

    Route::post('/messages/{id}/read', [MessageController::class, 'markAsRead']);

    Route::get('/apointments/{id}/prescription', [PrescriptionController::class, 'show']);

    Route::get('/notifications', [NotificationController::class, 'index']);
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead']);
});

Route::middleware(['auth:sanctum', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users/{id}/toggle-status', [UserController::class, 'toggleStatus']);
    Route::get('/appointments', [AdminAppointmentController::class, 'index']);
});

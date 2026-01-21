<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class], 'me');

    Route::middleware('role:professional')->group(function () {
        // availability
        // patient list
    });

    Route::middleware('role:client')->group(function () {
        // search professional
        // request appointment
    });

    Route::middleware('role:admin')->group(function () {
        // manage users
    });
});

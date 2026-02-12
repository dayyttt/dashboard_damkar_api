<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\AttendanceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Public routes
Route::post('/login', [AuthController::class, 'login']);
Route::get('/settings', [SettingController::class, 'index']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);
    
    // Attendance
    Route::post('/attendance', [AttendanceController::class, 'store']);
    Route::post('/attendance/validate', [AttendanceController::class, 'checkValidation']);
    Route::get('/attendance/history', [AttendanceController::class, 'history']);
    Route::get('/attendance/today', [AttendanceController::class, 'today']);
    
    // Fake GPS Log
    Route::post('/fake-gps-log', [AttendanceController::class, 'logFakeGps']);
});

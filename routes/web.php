<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;

// Redirect root to login/dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Authentication routes
Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.submit');
});

// Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::post('/attendance/login', [AttendanceController::class, 'login'])
        ->name('attendance.login');

    Route::post('/attendance/logout', [AttendanceController::class, 'logout'])
        ->name('attendance.logout');
        
    Route::get('/my-attendance', [AttendanceController::class, 'employee'])
    ->name('attendance.employee');
});

// Admin-only routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('employees', EmployeeController::class);

    Route::get('/attendance', [AttendanceController::class, 'index'])
        ->name('attendance.index');
});
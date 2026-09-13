<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ReportController;


// Redirect root to dashboard
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

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Employee attendance actions
    Route::post('/attendance/login', [AttendanceController::class, 'login'])
        ->name('attendance.login');

    Route::post('/attendance/logout', [AttendanceController::class, 'logout'])
        ->name('attendance.logout');

    // Employee own attendance
    Route::get('/my-attendance', [AttendanceController::class, 'employee'])
        ->name('attendance.employee');
});


// Admin-only routes
Route::middleware(['auth', 'admin'])->group(function () {

    // Employee management
    Route::resource('employees', EmployeeController::class);

    // Attendance management
    Route::get('/attendance', [AttendanceController::class, 'index'])
        ->name('attendance.index');

    Route::get('/attendance/{attendance}/edit', [AttendanceController::class, 'edit'])
        ->name('attendance.edit');

    Route::put('/attendance/{attendance}', [AttendanceController::class, 'update'])
        ->name('attendance.update');

    // Reports
    Route::get('/reports/daily', [ReportController::class, 'daily'])
        ->name('reports.daily');

    Route::get('/reports/monthly', [ReportController::class, 'monthly'])
        ->name('reports.monthly');
});
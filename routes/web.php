<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index']);
Route::resource('employees', EmployeeController::class);

// Route::get('/', function () {
//     return view('welcome');
// });

<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;

class DashboardController {

    public function index() {

        $today = today();

        $totalEmployees = Employee::where('is_active', true)->count();

        $todayAttendances = Attendance::whereDate(
            'attendance_date',
            $today
        )->get();

        $presentToday = $todayAttendances
            ->where('status', 'Present')
            ->count();

        $halfDayToday = $todayAttendances
            ->where('status', 'Half Day')
            ->count();

        $leaveToday = $todayAttendances
            ->where('status', 'Leave')
            ->count();

        $holidayToday = $todayAttendances
            ->where('status', 'Holiday')
            ->count();

        $absentToday = max(
            0,
            $totalEmployees
            - $presentToday
            - $halfDayToday
            - $leaveToday
            - $holidayToday
        );

        return view('dashboard.index', compact(
            'totalEmployees',
            'presentToday',
            'absentToday',
            'halfDayToday',
            'leaveToday'
        ));
    }
}
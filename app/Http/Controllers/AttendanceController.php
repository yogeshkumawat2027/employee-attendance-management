<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Services\AttendanceService;
use Exception;

class AttendanceController {

    public function login(AttendanceService $attendanceService) {
        $employee = auth()->user()->employee;

        if (!$employee) {
            abort(404, 'Employee profile not found.');
        }

        try {
            $attendanceService->markLogin($employee);

            return back()->with('success', 'Login marked successfully.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function logout(AttendanceService $attendanceService) {
        $employee = auth()->user()->employee;

        if (!$employee) {
            abort(404, 'Employee profile not found.');
        }

        try {
            $attendanceService->markLogout($employee);

            return back()->with('success', 'Logout marked successfully.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function index() {
        $attendances = \App\Models\Attendance::with('employee')
            ->latest('attendance_date')
            ->latest('login_time')
            ->get();

        return view('attendance.index', compact('attendances'));
    }
}
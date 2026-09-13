<?php

namespace App\Services;

use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
use Exception;

class AttendanceService {

    public function markLogin(Employee $employee) {
        if (!$employee->is_active) {
            throw new Exception('Employee is inactive.');
        }

        $today = Carbon::today();

        $attendance = Attendance::where('employee_id', $employee->id)
            ->whereDate('attendance_date', $today)
            ->first();

        if ($attendance && $attendance->login_time) {
            throw new Exception('Login already marked for today.');
        }

        if (!$attendance) {
            $attendance = Attendance::create([
                'employee_id' => $employee->id,
                'attendance_date' => $today,
                'login_time' => now()->format('H:i:s'),
                'status' => 'Absent',
            ]);
        } else {
            $attendance->update([
                'login_time' => now()->format('H:i:s'),
            ]);
        }

        return $attendance;
    }

    public function markLogout(Employee $employee) {
        $today = Carbon::today();

        $attendance = Attendance::where('employee_id', $employee->id)
            ->whereDate('attendance_date', $today)
            ->first();

        if (!$attendance || !$attendance->login_time) {
            throw new Exception('You must login before logout.');
        }

        if ($attendance->logout_time) {
            throw new Exception('Logout already marked for today.');
        }

        $loginTime = Carbon::parse($attendance->login_time);
        $logoutTime = now();

        if ($logoutTime->lessThan($loginTime)) {
            throw new Exception('Logout time cannot be earlier than login time.');
        }

        $workingHours = $this->calculateWorkingHours(
            $loginTime,
            $logoutTime
        );

        $status = $this->calculateStatus($workingHours);

        $attendance->update([
            'logout_time' => $logoutTime->format('H:i:s'),
            'working_hours' => $workingHours,
            'status' => $status,
        ]);

        return $attendance;
    }

    private function calculateWorkingHours(Carbon $loginTime, Carbon $logoutTime) {
        $minutes = $loginTime->diffInMinutes($logoutTime);

        return round($minutes / 60, 2);
    }

    private function calculateStatus($workingHours) {
        if ($workingHours < 4) {
            return 'Half Day';
        }

        if ($workingHours >= 8) {
            return 'Present';
        }

        return 'Present';
    }
}
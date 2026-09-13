<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Services\AttendanceService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AttendanceController {

    public function login(AttendanceService $attendanceService) {

        $employee = auth()->user()->employee;

        if (!$employee) {
            abort(404, 'Employee profile not found.');
        }

        try {
            $attendanceService->markLogin($employee);

            return back()->with(
                'success',
                'Login marked successfully.'
            );

        } catch (Exception $e) {

            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }

    public function logout(AttendanceService $attendanceService) {

        $employee = auth()->user()->employee;

        if (!$employee) {
            abort(404, 'Employee profile not found.');
        }

        try {
            $attendanceService->markLogout($employee);

            return back()->with(
                'success',
                'Logout marked successfully.'
            );

        } catch (Exception $e) {

            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }

    public function index() {

        $attendances = Attendance::with('employee')
            ->latest('attendance_date')
            ->latest('login_time')
            ->get();

        return view(
            'attendance.index',
            compact('attendances')
        );
    }

    public function employee() {

        $employee = auth()->user()->employee;

        if (!$employee) {
            abort(404, 'Employee profile not found.');
        }

        $todayAttendance = $employee->attendances()
            ->whereDate('attendance_date', today())
            ->first();

        $attendances = $employee->attendances()
            ->latest('attendance_date')
            ->get();

        return view(
            'attendance.employee',
            compact(
                'employee',
                'todayAttendance',
                'attendances'
            )
        );
    }

    public function edit(Attendance $attendance) {

        $attendance->load('employee');

        return view(
            'attendance.edit',
            compact('attendance')
        );
    }

    public function update(
        Request $request,
        Attendance $attendance
    ) {

        $validated = $request->validate([

            'attendance_date' => [
                'required',
                'date',

                Rule::unique('attendances', 'attendance_date')
                    ->where(function ($query) use ($attendance) {

                        return $query->where(
                            'employee_id',
                            $attendance->employee_id
                        );
                    })
                    ->ignore($attendance->id),
            ],

            'login_time' => [
                'nullable',
                'date_format:H:i',
            ],

            'logout_time' => [
                'nullable',
                'date_format:H:i',
            ],

            'status' => [
                'required',
                'in:Present,Absent,Half Day,Leave,Holiday',
            ],
        ]);

        /*
         * If both login and logout times are provided,
         * calculate working hours and status automatically.
         */

        if (
            $validated['login_time'] &&
            $validated['logout_time']
        ) {

            $loginTime = Carbon::createFromFormat(
                'H:i',
                $validated['login_time']
            );

            $logoutTime = Carbon::createFromFormat(
                'H:i',
                $validated['logout_time']
            );

            /*
             * Logout cannot be earlier than login.
             */

            if ($logoutTime->lessThan($loginTime)) {

                return back()
                    ->withErrors([
                        'logout_time' =>
                            'Logout time cannot be earlier than login time.'
                    ])
                    ->withInput();
            }

            /*
             * Calculate working hours.
             */

            $minutes = $loginTime->diffInMinutes(
                $logoutTime
            );

            $workingHours = round(
                $minutes / 60,
                2
            );

            $validated['working_hours'] = $workingHours;

            /*
             * Automatically calculate status.
             *
             * Less than 4 hours = Half Day
             * 4 hours or more = Present
             */

            if ($workingHours < 4) {

                $validated['status'] = 'Half Day';

            } else {

                $validated['status'] = 'Present';
            }

        } else {

            /*
             * If login/logout are not both provided,
             * admin-selected status is used.
             */

            $validated['working_hours'] = null;
        }

        $attendance->update($validated);

        return redirect()
            ->route('attendance.index')
            ->with(
                'success',
                'Attendance updated successfully.'
            );
    }
}
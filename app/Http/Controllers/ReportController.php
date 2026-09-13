<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;

class ReportController {

    public function daily(Request $request) {

        $date = $request->input(
            'date',
            today()->format('Y-m-d')
        );

        $employees = Employee::where('is_active', true)
            ->orderBy('employee_code')
            ->get();

        $attendances = Attendance::with('employee')
            ->whereDate('attendance_date', $date)
            ->get()
            ->keyBy('employee_id');

        return view(
            'reports.daily',
            compact(
                'employees',
                'attendances',
                'date'
            )
        );
    }
}
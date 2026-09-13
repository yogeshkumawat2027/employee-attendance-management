
@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="page-title mb-1">
            Employee Attendance
        </h2>

        <p class="page-subtitle mb-0">
            {{ $employee->name }}
            ·
            {{ $employee->employee_code }}
        </p>

    </div>

    <a
        href="{{ route('employees.index') }}"
        class="btn btn-outline-secondary"
    >
        Back to Employees
    </a>

</div>


<div class="row g-3 mb-4">

    <div class="col-md-4">

        <div class="card shadow-sm h-100">

            <div class="card-body">

                <div class="text-muted small mb-1">
                    Employee
                </div>

                <h5 class="mb-0">
                    {{ $employee->name }}
                </h5>

            </div>

        </div>

    </div>


    <div class="col-md-4">

        <div class="card shadow-sm h-100">

            <div class="card-body">

                <div class="text-muted small mb-1">
                    Department
                </div>

                <h5 class="mb-0">
                    {{ $employee->department ?? '-' }}
                </h5>

            </div>

        </div>

    </div>


    <div class="col-md-4">

        <div class="card shadow-sm h-100">

            <div class="card-body">

                <div class="text-muted small mb-1">
                    Designation
                </div>

                <h5 class="mb-0">
                    {{ $employee->designation ?? '-' }}
                </h5>

            </div>

        </div>

    </div>

</div>


<div class="card shadow-sm">

    <div class="card-body p-0">

        <div class="p-3 border-bottom">

            <h5 class="mb-0">
                Complete Attendance History
            </h5>

        </div>

        <div class="table-responsive">

            <table class="table table-hover">

                <thead class="table-light">

                    <tr>

                        <th>
                            Date
                        </th>

                        <th>
                            Login
                        </th>

                        <th>
                            Logout
                        </th>

                        <th>
                            Working Hours
                        </th>

                        <th>
                            Status
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($attendances as $attendance)

                        <tr>

                            <td>
                                {{ $attendance->attendance_date->format('d M Y') }}
                            </td>

                            <td>
                                {{ $attendance->login_time ?? '-' }}
                            </td>

                            <td>
                                {{ $attendance->logout_time ?? '-' }}
                            </td>

                            <td>

                                @if($attendance->working_hours !== null)

                                    {{ $attendance->working_hours }}
                                    hrs

                                @else

                                    -

                                @endif

                            </td>

                            <td>

                                @if($attendance->status === 'Present')

                                    <span class="badge bg-success">
                                        Present
                                    </span>

                                @elseif($attendance->status === 'Half Day')

                                    <span class="badge bg-warning text-dark">
                                        Half Day
                                    </span>

                                @elseif($attendance->status === 'Leave')

                                    <span class="badge bg-info">
                                        Leave
                                    </span>

                                @elseif($attendance->status === 'Holiday')

                                    <span class="badge bg-secondary">
                                        Holiday
                                    </span>

                                @else

                                    <span class="badge bg-danger">
                                        Absent
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="5"
                                class="text-center text-muted py-5"
                            >
                                No attendance records found.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection

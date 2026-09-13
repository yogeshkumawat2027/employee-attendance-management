@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="page-title mb-1">
            Attendance
        </h2>

        <p class="page-subtitle mb-0">
            Manage employee attendance records
        </p>
    </div>

    <div class="d-flex gap-2">

        <a
            href="{{ route('reports.daily') }}"
            class="btn btn-outline-primary"
        >
            Daily Report
        </a>

        <a
            href="{{ route('reports.monthly') }}"
            class="btn btn-outline-secondary"
        >
            Monthly Report
        </a>

    </div>

</div>

<div class="card shadow-sm">

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover">

                <thead class="table-light">

                    <tr>
                        <th>Employee</th>
                        <th>Code</th>
                        <th>Date</th>
                        <th>Login</th>
                        <th>Logout</th>
                        <th>Hours</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($attendances as $attendance)

                        <tr>

                            <td>
                                {{ $attendance->employee->name }}
                            </td>

                            <td>
                                {{ $attendance->employee->employee_code }}
                            </td>

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
                                {{ $attendance->working_hours ?? '-' }}
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

                            <td>

                                <a
                                    href="{{ route('attendance.edit', $attendance) }}"
                                    class="btn btn-sm btn-outline-primary"
                                >
                                    Edit
                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="8"
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
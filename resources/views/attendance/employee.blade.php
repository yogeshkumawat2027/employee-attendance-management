@extends('layouts.app')

@section('content')

<div class="mb-4">

    <h2 class="page-title mb-1">
        My Attendance
    </h2>

    <p class="page-subtitle mb-0">
        Mark today's attendance and view your history
    </p>

</div>

<div class="card shadow-sm mb-4">

    <div class="card-body p-4">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h5 class="fw-bold mb-1">
                    Today's Attendance
                </h5>

                <span class="text-muted">
                    {{ today()->format('d M Y') }}
                </span>
            </div>

            @if($todayAttendance)

                @if($todayAttendance->status === 'Present')

                    <span class="badge bg-success fs-6">
                        Present
                    </span>

                @elseif($todayAttendance->status === 'Half Day')

                    <span class="badge bg-warning text-dark fs-6">
                        Half Day
                    </span>

                @else

                    <span class="badge bg-secondary fs-6">
                        {{ $todayAttendance->status }}
                    </span>

                @endif

            @endif

        </div>

        @if($todayAttendance)

            <div class="row g-4 mb-4">

                <div class="col-md-3">

                    <div class="text-muted small">
                        Employee
                    </div>

                    <strong>
                        {{ $employee->name }}
                    </strong>

                </div>

                <div class="col-md-3">

                    <div class="text-muted small">
                        Login
                    </div>

                    <strong>
                        {{ $todayAttendance->login_time ?? '-' }}
                    </strong>

                </div>

                <div class="col-md-3">

                    <div class="text-muted small">
                        Logout
                    </div>

                    <strong>
                        {{ $todayAttendance->logout_time ?? '-' }}
                    </strong>

                </div>

                <div class="col-md-3">

                    <div class="text-muted small">
                        Working Hours
                    </div>

                    <strong>
                        {{ $todayAttendance->working_hours ?? '-' }}
                    </strong>

                </div>

            </div>

            @if(!$todayAttendance->logout_time)

                <form
                    action="{{ route('attendance.logout') }}"
                    method="POST"
                >

                    @csrf

                    <button
                        type="submit"
                        class="btn btn-danger"
                    >
                        Mark Logout
                    </button>

                </form>

            @else

                <div class="alert alert-success mb-0">
                    Today's attendance is complete.
                </div>

            @endif

        @else

            <div class="text-center py-3">

                <p class="text-muted">
                    You have not marked attendance today.
                </p>

                <form
                    action="{{ route('attendance.login') }}"
                    method="POST"
                >

                    @csrf

                    <button
                        type="submit"
                        class="btn btn-success px-4"
                    >
                        Mark Login
                    </button>

                </form>

            </div>

        @endif

    </div>

</div>

<div class="card shadow-sm">

    <div class="card-body">

        <h5 class="fw-bold mb-3">
            Attendance History
        </h5>

        <div class="table-responsive">

            <table class="table table-hover">

                <thead class="table-light">

                    <tr>
                        <th>Date</th>
                        <th>Login</th>
                        <th>Logout</th>
                        <th>Working Hours</th>
                        <th>Status</th>
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

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="5"
                                class="text-center text-muted py-5"
                            >
                                No attendance history found.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection
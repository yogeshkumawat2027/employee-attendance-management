@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="page-title mb-1">
            Edit Attendance
        </h2>

        <p class="page-subtitle mb-0">
            {{ $attendance->employee->name }}
            ·
            {{ $attendance->employee->employee_code }}
        </p>

    </div>

    <a
        href="{{ route('attendance.index') }}"
        class="btn btn-outline-secondary"
    >
        Back
    </a>

</div>

<div class="card shadow-sm">

    <div class="card-body p-4">

        <form
            action="{{ route('attendance.update', $attendance) }}"
            method="POST"
        >

            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Attendance Date
                    </label>

                    <input
                        type="date"
                        name="attendance_date"
                        class="form-control"
                        value="{{ old(
                            'attendance_date',
                            $attendance->attendance_date->format('Y-m-d')
                        ) }}"
                        required
                    >

                    @error('attendance_date')
                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Status
                    </label>

                    <select
                        name="status"
                        class="form-select"
                        required
                    >

                        @foreach([
                            'Present',
                            'Absent',
                            'Half Day',
                            'Leave',
                            'Holiday'
                        ] as $status)

                            <option
                                value="{{ $status }}"
                                @selected(
                                    old(
                                        'status',
                                        $attendance->status
                                    ) === $status
                                )
                            >
                                {{ $status }}
                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Login Time
                    </label>

                    <input
                        type="time"
                        name="login_time"
                        class="form-control"
                        value="{{ old(
                            'login_time',
                            $attendance->login_time
                                ? substr($attendance->login_time, 0, 5)
                                : ''
                        ) }}"
                    >

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Logout Time
                    </label>

                    <input
                        type="time"
                        name="logout_time"
                        class="form-control"
                        value="{{ old(
                            'logout_time',
                            $attendance->logout_time
                                ? substr($attendance->logout_time, 0, 5)
                                : ''
                        ) }}"
                    >

                    @error('logout_time')
                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

            </div>

            <div class="alert alert-info">

                Working hours and status are automatically calculated
                when both login and logout times are provided.

            </div>

            <button
                type="submit"
                class="btn btn-primary"
            >
                Update Attendance
            </button>

        </form>

    </div>

</div>

@endsection
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Attendance</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body class="bg-light">

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2>Edit Attendance</h2>

            <p class="text-muted mb-0">
                {{ $attendance->employee->name }}
                ({{ $attendance->employee->employee_code }})
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

        <div class="card-body">

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
                            class="form-control @error('attendance_date') is-invalid @enderror"
                            value="{{ old('attendance_date', $attendance->attendance_date->format('Y-m-d')) }}"
                            required
                        >

                        @error('attendance_date')
                            <div class="invalid-feedback">
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
                            class="form-select @error('status') is-invalid @enderror"
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
                                    @selected(old('status', $attendance->status) === $status)
                                >
                                    {{ $status }}
                                </option>

                            @endforeach

                        </select>

                        @error('status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Login Time
                        </label>

                        <input
                            type="time"
                            name="login_time"
                            class="form-control @error('login_time') is-invalid @enderror"
                            value="{{ old('login_time', $attendance->login_time ? substr($attendance->login_time, 0, 5) : '') }}"
                        >

                        @error('login_time')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Logout Time
                        </label>

                        <input
                            type="time"
                            name="logout_time"
                            class="form-control @error('logout_time') is-invalid @enderror"
                            value="{{ old('logout_time', $attendance->logout_time ? substr($attendance->logout_time, 0, 5) : '') }}"
                        >

                        @error('logout_time')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>

                <div class="alert alert-info">
                    Working hours will be calculated automatically
                    from login and logout time.
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

</div>

</body>
</html>
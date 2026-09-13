<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Daily Attendance Report</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body class="bg-light">

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2>Daily Attendance Report</h2>

            <p class="text-muted mb-0">
                View attendance for a specific date
            </p>
        </div>

        <div class="d-flex gap-2">

            <a
                href="{{ route('dashboard') }}"
                class="btn btn-outline-primary"
            >
                Dashboard
            </a>

            <a
                href="{{ route('attendance.index') }}"
                class="btn btn-outline-secondary"
            >
                Attendance
            </a>

        </div>

    </div>

    {{-- Date Filter --}}

    <div class="card shadow-sm mb-4">

        <div class="card-body">

            <form
                action="{{ route('reports.daily') }}"
                method="GET"
                class="row g-3 align-items-end"
            >

                <div class="col-md-4">

                    <label class="form-label">
                        Select Date
                    </label>

                    <input
                        type="date"
                        name="date"
                        class="form-control"
                        value="{{ $date }}"
                        required
                    >

                </div>

                <div class="col-md-2">

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        View Report
                    </button>

                </div>

            </form>

        </div>

    </div>

    {{-- Attendance Table --}}

    <div class="card shadow-sm">

        <div class="card-body">

            <h5 class="mb-3">
                Attendance for
                {{ \Carbon\Carbon::parse($date)->format('d M Y') }}
            </h5>

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-light">

                        <tr>

                            <th>Employee Code</th>

                            <th>Employee</th>

                            <th>Department</th>

                            <th>Login</th>

                            <th>Logout</th>

                            <th>Working Hours</th>

                            <th>Status</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($employees as $employee)

                            @php
                                $attendance = $attendances->get($employee->id);

                                $status = $attendance?->status ?? 'Absent';
                            @endphp

                            <tr>

                                <td>
                                    {{ $employee->employee_code }}
                                </td>

                                <td>
                                    {{ $employee->name }}
                                </td>

                                <td>
                                    {{ $employee->department ?? '-' }}
                                </td>

                                <td>
                                    {{ $attendance?->login_time ?? '-' }}
                                </td>

                                <td>
                                    {{ $attendance?->logout_time ?? '-' }}
                                </td>

                                <td>
                                    {{ $attendance?->working_hours ?? '-' }}
                                </td>

                                <td>

                                    @if($status === 'Present')

                                        <span class="badge bg-success">
                                            Present
                                        </span>

                                    @elseif($status === 'Half Day')

                                        <span class="badge bg-warning text-dark">
                                            Half Day
                                        </span>

                                    @elseif($status === 'Leave')

                                        <span class="badge bg-info">
                                            Leave
                                        </span>

                                    @elseif($status === 'Holiday')

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
                                    colspan="7"
                                    class="text-center text-muted py-4"
                                >
                                    No active employees found.
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

</body>
</html>
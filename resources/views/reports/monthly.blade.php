<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Monthly Attendance Report</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body class="bg-light">

<div class="container py-5">

    {{-- Header --}}

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2>Monthly Attendance Report</h2>

            <p class="text-muted mb-0">
                Employee-wise attendance summary
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
                href="{{ route('reports.daily') }}"
                class="btn btn-outline-secondary"
            >
                Daily Report
            </a>

        </div>

    </div>

    {{-- Month / Year Filter --}}

    <div class="card shadow-sm mb-4">

        <div class="card-body">

            <form
                action="{{ route('reports.monthly') }}"
                method="GET"
                class="row g-3 align-items-end"
            >

                <div class="col-md-4">

                    <label class="form-label">
                        Month
                    </label>

                    <select
                        name="month"
                        class="form-select"
                        required
                    >

                        @foreach(range(1, 12) as $monthNumber)

                            <option
                                value="{{ sprintf('%02d', $monthNumber) }}"
                                @selected(
                                    (int) $month === $monthNumber
                                )
                            >
                                {{ \Carbon\Carbon::create()
                                    ->month($monthNumber)
                                    ->format('F') }}
                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-md-3">

                    <label class="form-label">
                        Year
                    </label>

                    <select
                        name="year"
                        class="form-select"
                        required
                    >

                        @foreach(range(now()->year - 2, now()->year + 1) as $yearOption)

                            <option
                                value="{{ $yearOption }}"
                                @selected(
                                    (int) $year === $yearOption
                                )
                            >
                                {{ $yearOption }}
                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-md-3">

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

    {{-- Report --}}

    <div class="card shadow-sm">

        <div class="card-body">

            <h5 class="mb-3">

                Report for
                {{ \Carbon\Carbon::createFromDate(
                    $year,
                    $month,
                    1
                )->format('F Y') }}

            </h5>

            <div class="table-responsive">

                <table
                    class="table table-bordered table-hover align-middle"
                >

                    <thead class="table-light">

                        <tr>

                            <th>Employee Code</th>

                            <th>Employee</th>

                            <th>Department</th>

                            <th>Present</th>

                            <th>Half Day</th>

                            <th>Leave</th>

                            <th>Holiday</th>

                            <th>Absent</th>

                            <th>Total Hours</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($employees as $employee)

                            @php

                                $employeeAttendances = $attendances
                                    ->where(
                                        'employee_id',
                                        $employee->id
                                    );

                                $present = $employeeAttendances
                                    ->where(
                                        'status',
                                        'Present'
                                    )
                                    ->count();

                                $halfDay = $employeeAttendances
                                    ->where(
                                        'status',
                                        'Half Day'
                                    )
                                    ->count();

                                $leave = $employeeAttendances
                                    ->where(
                                        'status',
                                        'Leave'
                                    )
                                    ->count();

                                $holiday = $employeeAttendances
                                    ->where(
                                        'status',
                                        'Holiday'
                                    )
                                    ->count();

                                $absent = $employeeAttendances
                                    ->where(
                                        'status',
                                        'Absent'
                                    )
                                    ->count();

                                $totalHours = $employeeAttendances
                                    ->sum(
                                        'working_hours'
                                    );

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
                                    <span class="badge bg-success">
                                        {{ $present }}
                                    </span>
                                </td>

                                <td>
                                    <span class="badge bg-warning text-dark">
                                        {{ $halfDay }}
                                    </span>
                                </td>

                                <td>
                                    <span class="badge bg-info">
                                        {{ $leave }}
                                    </span>
                                </td>

                                <td>
                                    <span class="badge bg-secondary">
                                        {{ $holiday }}
                                    </span>
                                </td>

                                <td>
                                    <span class="badge bg-danger">
                                        {{ $absent }}
                                    </span>
                                </td>

                                <td>
                                    {{ number_format($totalHours, 2) }}
                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="9"
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
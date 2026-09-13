<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Attendance Management</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body class="bg-light">

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2>Attendance Management</h2>
            <p class="text-muted mb-0">
                Manage employee attendance
            </p>
        </div>

        <a href="{{ route('dashboard') }}" class="btn btn-outline-primary">
            Dashboard
        </a>

    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-light">
                        <tr>
                            <th>Employee Code</th>
                            <th>Employee</th>
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
                                    {{ $attendance->employee->employee_code }}
                                </td>

                                <td>
                                    {{ $attendance->employee->name }}
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

                            </tr>

                        @empty

                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    No attendance records found.
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
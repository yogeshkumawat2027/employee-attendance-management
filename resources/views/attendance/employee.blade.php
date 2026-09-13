<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Attendance</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body class="bg-light">

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2>My Attendance</h2>
            <p class="text-muted mb-0">
                Welcome, {{ auth()->user()->name }}
            </p>
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-danger">
                Logout
            </button>
        </form>
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

    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <h5 class="mb-3">Today's Attendance</h5>

            @if($todayAttendance)

                <div class="row">

                    <div class="col-md-3">
                        <strong>Date</strong>
                        <p>{{ $todayAttendance->attendance_date->format('d M Y') }}</p>
                    </div>

                    <div class="col-md-3">
                        <strong>Login</strong>
                        <p>
                            {{ $todayAttendance->login_time ?? '-' }}
                        </p>
                    </div>

                    <div class="col-md-3">
                        <strong>Logout</strong>
                        <p>
                            {{ $todayAttendance->logout_time ?? '-' }}
                        </p>
                    </div>

                    <div class="col-md-3">
                        <strong>Status</strong>
                        <p>
                            <span class="badge bg-primary">
                                {{ $todayAttendance->status }}
                            </span>
                        </p>
                    </div>

                </div>

                @if(!$todayAttendance->logout_time)
                    <form action="{{ route('attendance.logout') }}" method="POST">
                        @csrf

                        <button type="submit" class="btn btn-danger">
                            Mark Logout
                        </button>
                    </form>
                @endif

            @else

                <p class="text-muted">
                    You have not marked attendance today.
                </p>

                <form action="{{ route('attendance.login') }}" method="POST">
                    @csrf

                    <button type="submit" class="btn btn-success">
                        Mark Login
                    </button>
                </form>

            @endif

        </div>
    </div>

    <div class="card shadow-sm">

        <div class="card-body">

            <h5 class="mb-3">Attendance History</h5>

            <div class="table-responsive">

                <table class="table table-bordered align-middle">

                    <thead>
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
                                    {{ $attendance->status }}
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="5" class="text-center text-muted">
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
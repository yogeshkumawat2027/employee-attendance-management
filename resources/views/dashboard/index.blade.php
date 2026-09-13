<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard - Attendance Management</title>

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
                Welcome, {{ auth()->user()->name }}
            </p>
        </div>

        <div class="d-flex gap-2">

            @if(auth()->user()->role === 'admin')

                <a
                    href="{{ route('employees.index') }}"
                    class="btn btn-primary"
                >
                    Employees
                </a>

                <a
                    href="{{ route('attendance.index') }}"
                    class="btn btn-outline-primary"
                >
                    Attendance
                </a>

            @else

                <a
                    href="{{ route('attendance.employee') }}"
                    class="btn btn-primary"
                >
                    My Attendance
                </a>

            @endif

            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button
                    type="submit"
                    class="btn btn-outline-danger"
                >
                    Logout
                </button>
            </form>

        </div>

    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row g-4">

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5>Total Employees</h5>
                    <h2>{{ $totalEmployees }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5>Present Today</h5>
                    <h2>{{ $presentToday }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5>Absent Today</h5>
                    <h2>{{ $absentToday }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5>Half Day</h5>
                    <h2>{{ $halfDayToday }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5>Employees on Leave</h5>
                    <h2>{{ $leaveToday }}</h2>
                </div>
            </div>
        </div>

    </div>

</div>

</body>
</html>
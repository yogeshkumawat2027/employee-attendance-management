@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="page-title mb-1">
            Dashboard
        </h2>

        <p class="page-subtitle mb-0">
            Overview of your attendance management system
        </p>
    </div>

</div>

@if(auth()->user()->role === 'admin')

    <div class="row g-4">

        <div class="col-md-6 col-xl-3">

            <div class="card shadow-sm stat-card">
                <div class="card-body">

                    <div class="stat-title">
                        Total Employees
                    </div>

                    <div class="stat-number mt-2">
                        {{ $totalEmployees }}
                    </div>

                </div>
            </div>

        </div>

        <div class="col-md-6 col-xl-3">

            <div class="card shadow-sm stat-card">
                <div class="card-body">

                    <div class="stat-title">
                        Present Today
                    </div>

                    <div class="stat-number text-success mt-2">
                        {{ $presentToday }}
                    </div>

                </div>
            </div>

        </div>

        <div class="col-md-6 col-xl-3">

            <div class="card shadow-sm stat-card">
                <div class="card-body">

                    <div class="stat-title">
                        Absent Today
                    </div>

                    <div class="stat-number text-danger mt-2">
                        {{ $absentToday }}
                    </div>

                </div>
            </div>

        </div>

        <div class="col-md-6 col-xl-3">

            <div class="card shadow-sm stat-card">
                <div class="card-body">

                    <div class="stat-title">
                        Half Day
                    </div>

                    <div class="stat-number text-warning mt-2">
                        {{ $halfDayToday }}
                    </div>

                </div>
            </div>

        </div>

        <div class="col-md-6 col-xl-3">

            <div class="card shadow-sm stat-card">
                <div class="card-body">

                    <div class="stat-title">
                        Employees on Leave
                    </div>

                    <div class="stat-number text-info mt-2">
                        {{ $leaveToday }}
                    </div>

                </div>
            </div>

        </div>

    </div>

    <div class="card shadow-sm mt-4">

        <div class="card-body">

            <h5 class="fw-bold mb-3">
                Quick Actions
            </h5>

            <div class="d-flex flex-wrap gap-2">

                <a
                    href="{{ route('employees.create') }}"
                    class="btn btn-primary"
                >
                    Add Employee
                </a>

                <a
                    href="{{ route('attendance.index') }}"
                    class="btn btn-outline-primary"
                >
                    Manage Attendance
                </a>

                <a
                    href="{{ route('reports.daily') }}"
                    class="btn btn-outline-secondary"
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

    </div>

@else

    <div class="card shadow-sm">

        <div class="card-body p-4">

            <h4 class="fw-bold">
                Welcome, {{ auth()->user()->name }}
            </h4>

            <p class="text-muted">
                Manage your daily attendance and view your attendance history.
            </p>

            <a
                href="{{ route('attendance.employee') }}"
                class="btn btn-primary"
            >
                Go to My Attendance
            </a>

        </div>

    </div>

@endif

@endsection
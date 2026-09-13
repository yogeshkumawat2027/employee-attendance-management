<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>{{ $title ?? 'Attendance Management' }}</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>

        body {
            background: #f5f7fb;
            color: #212529;
        }

        .navbar {
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
        }

        .brand {
            font-weight: 700;
            color: #0d6efd;
            text-decoration: none;
        }

        .nav-link {
            color: #6b7280;
            font-weight: 500;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #0d6efd;
        }

        .page-container {
            padding-top: 35px;
            padding-bottom: 50px;
        }

        .card {
            border: 0;
            border-radius: 14px;
        }

        .stat-card {
            transition: transform 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
        }

        .stat-title {
            color: #6b7280;
            font-size: 14px;
            font-weight: 600;
        }

        .stat-number {
            font-size: 30px;
            font-weight: 700;
        }

        .table {
            margin-bottom: 0;
        }

        .table th {
            font-size: 13px;
            color: #6b7280;
            white-space: nowrap;
        }

        .table td {
            vertical-align: middle;
        }

        .page-title {
            font-weight: 700;
        }

        .page-subtitle {
            color: #6b7280;
        }

        .profile-badge {
            background: #eef4ff;
            color: #0d6efd;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
        }

    </style>

</head>

<body>

<nav class="navbar navbar-expand-lg sticky-top">

    <div class="container">

        <a
            href="{{ route('dashboard') }}"
            class="brand fs-5"
        >
            Attendance Management
        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#mainNavbar"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div
            class="collapse navbar-collapse"
            id="mainNavbar"
        >

            <ul class="navbar-nav me-auto ms-lg-4">

                <li class="nav-item">
                    <a
                        href="{{ route('dashboard') }}"
                        class="nav-link"
                    >
                        Dashboard
                    </a>
                </li>

                @if(auth()->user()->role === 'admin')

                    <li class="nav-item">
                        <a
                            href="{{ route('employees.index') }}"
                            class="nav-link"
                        >
                            Employees
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            href="{{ route('attendance.index') }}"
                            class="nav-link"
                        >
                            Attendance
                        </a>
                    </li>

                    <li class="nav-item dropdown">

                        <a
                            href="#"
                            class="nav-link dropdown-toggle"
                            data-bs-toggle="dropdown"
                        >
                            Reports
                        </a>

                        <ul class="dropdown-menu">

                            <li>
                                <a
                                    href="{{ route('reports.daily') }}"
                                    class="dropdown-item"
                                >
                                    Daily Report
                                </a>
                            </li>

                            <li>
                                <a
                                    href="{{ route('reports.monthly') }}"
                                    class="dropdown-item"
                                >
                                    Monthly Report
                                </a>
                            </li>

                        </ul>

                    </li>

                @else

                    <li class="nav-item">
                        <a
                            href="{{ route('attendance.employee') }}"
                            class="nav-link"
                        >
                            My Attendance
                        </a>
                    </li>

                @endif

            </ul>

            <div class="d-flex align-items-center gap-3">

                <div class="d-none d-md-block">
                    <span class="profile-badge">
                        {{ auth()->user()->name }}
                        ·
                        {{ ucfirst(auth()->user()->role) }}
                    </span>
                </div>

                <form
                    action="{{ route('logout') }}"
                    method="POST"
                >
                    @csrf

                    <button
                        type="submit"
                        class="btn btn-outline-danger btn-sm"
                    >
                        Logout
                    </button>

                </form>

            </div>

        </div>

    </div>

</nav>

<div class="container page-container">

    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif

    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show">

            {{ session('error') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif

    @yield('content')

</div>

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>

</body>

</html>
@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="page-title mb-1">
            Daily Attendance Report
        </h2>

        <p class="page-subtitle mb-0">
            Attendance of all active employees
        </p>

    </div>

    <a
        href="{{ route('reports.monthly') }}"
        class="btn btn-outline-primary"
    >
        Monthly Report
    </a>

</div>

<div class="card shadow-sm mb-4">

    <div class="card-body">

        <form
            action="{{ route('reports.daily') }}"
            method="GET"
            class="row g-3 align-items-end"
        >

            <div class="col-md-4">

                <label class="form-label fw-semibold">
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

<div class="card shadow-sm">

    <div class="card-body">

        <h5 class="fw-bold mb-3">

            {{ \Carbon\Carbon::parse($date)->format('d M Y') }}

        </h5>

        <div class="table-responsive">

            <table class="table table-hover">

                <thead class="table-light">

                    <tr>
                        <th>Code</th>
                        <th>Employee</th>
                        <th>Department</th>
                        <th>Login</th>
                        <th>Logout</th>
                        <th>Hours</th>
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
                                class="text-center text-muted py-5"
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

@endsection
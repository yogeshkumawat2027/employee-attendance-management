
@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="page-title mb-1">
            Employees
        </h2>

        <p class="page-subtitle mb-0">
            Manage all employees
        </p>
    </div>

    <a
        href="{{ route('employees.create') }}"
        class="btn btn-primary"
    >
        + Add Employee
    </a>

</div>


@if($employees->isEmpty())

    <div class="card shadow-sm">

        <div class="card-body text-center py-5">

            <h5 class="mb-2">
                No employees found
            </h5>

            <p class="text-muted mb-3">
                Add your first employee to get started.
            </p>

            <a
                href="{{ route('employees.create') }}"
                class="btn btn-primary"
            >
                Add Employee
            </a>

        </div>

    </div>

@else

    <div class="card shadow-sm">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover">

                    <thead class="table-light">

                        <tr>

                            <th>
                                Code
                            </th>

                            <th>
                                Name
                            </th>

                            <th>
                                Email
                            </th>

                            <th>
                                Department
                            </th>

                            <th>
                                Designation
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Actions
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($employees as $employee)

                            <tr>

                                <td>
                                    <strong>
                                        {{ $employee->employee_code }}
                                    </strong>
                                </td>

                                <td>
                                    {{ $employee->name }}
                                </td>

                                <td>
                                    {{ $employee->email }}
                                </td>

                                <td>
                                    {{ $employee->department ?? '-' }}
                                </td>

                                <td>
                                    {{ $employee->designation ?? '-' }}
                                </td>

                                <td>

                                    @if($employee->is_active)

                                        <span class="badge bg-success">
                                            Active
                                        </span>

                                    @else

                                        <span class="badge bg-secondary">
                                            Inactive
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    <div class="d-flex gap-2">

                                        <a
                                            href="{{ route('employees.attendance', $employee) }}"
                                            class="btn btn-sm btn-outline-primary"
                                        >
                                            Attendance
                                        </a>

                                        <a
                                            href="{{ route('employees.edit', $employee) }}"
                                            class="btn btn-sm btn-outline-secondary"
                                        >
                                            Edit
                                        </a>

                                        @if($employee->is_active)

                                            <form
                                                action="{{ route('employees.destroy', $employee) }}"
                                                method="POST"
                                            >

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Deactivate this employee?')"
                                                >
                                                    Deactivate
                                                </button>

                                            </form>

                                        @endif

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

@endif

@endsection


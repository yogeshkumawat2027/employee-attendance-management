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

<div class="card shadow-sm">

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover">

                <thead class="table-light">

                    <tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Designation</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($employees as $employee)

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
                                        href="{{ route('employees.edit', $employee) }}"
                                        class="btn btn-sm btn-outline-primary"
                                    >
                                        Edit
                                    </a>

                                    @if($employee->is_active)

                                        <form
                                            action="{{ route('employees.destroy', $employee) }}"
                                            method="POST"
                                            onsubmit="return confirm('Deactivate this employee?')"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-outline-danger"
                                            >
                                                Deactivate
                                            </button>

                                        </form>

                                    @endif

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="text-center text-muted py-5"
                            >
                                No employees found.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection
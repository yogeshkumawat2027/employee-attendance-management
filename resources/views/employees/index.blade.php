<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <a href="{{ url('/') }}" class="navbar-brand">
            Attendance Management
        </a>
    </div>
</nav>

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Employees</h1>

        <a href="{{ route('employees.create') }}" class="btn btn-primary">
            + Add Employee
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">

            @if($employees->count())

                <div class="table-responsive">
                    <table class="table table-hover align-middle">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Employee Code</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Department</th>
                                <th>Designation</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($employees as $employee)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        {{ $employee->employee_code }}
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
                                        <a
                                            href="{{ route('employees.edit', $employee) }}"
                                            class="btn btn-sm btn-warning"
                                        >
                                            Edit
                                        </a>

                                        @if($employee->is_active)
                                            <form
                                                action="{{ route('employees.destroy', $employee) }}"
                                                method="POST"
                                                class="d-inline"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Deactivate this employee?')"
                                                >
                                                    Deactivate
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

            @else

                <div class="text-center py-5">
                    <h5>No employees found</h5>

                    <p class="text-muted">
                        Add your first employee to get started.
                    </p>

                    <a
                        href="{{ route('employees.create') }}"
                        class="btn btn-primary"
                    >
                        Add Employee
                    </a>
                </div>

            @endif

        </div>
    </div>

</div>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <a href="{{ route('employees.index') }}" class="navbar-brand">
            Attendance Management
        </a>
    </div>
</nav>

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Employee</h1>

        <a href="{{ route('employees.index') }}" class="btn btn-secondary">
            Back
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">

            <form
                action="{{ route('employees.update', $employee) }}"
                method="POST"
            >

                @csrf
                @method('PUT')

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Employee Code</label>

                        <input
                            type="text"
                            name="employee_code"
                            class="form-control"
                            value="{{ old('employee_code', $employee->employee_code) }}"
                            required
                        >
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Name</label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            value="{{ old('name', $employee->name) }}"
                            required
                        >
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email</label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            value="{{ old('email', $employee->email) }}"
                            required
                        >
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Phone</label>

                        <input
                            type="text"
                            name="phone"
                            class="form-control"
                            value="{{ old('phone', $employee->phone) }}"
                        >
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Department</label>

                        <input
                            type="text"
                            name="department"
                            class="form-control"
                            value="{{ old('department', $employee->department) }}"
                        >
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Designation</label>

                        <input
                            type="text"
                            name="designation"
                            class="form-control"
                            value="{{ old('designation', $employee->designation) }}"
                        >
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Joining Date</label>

                        <input
                            type="date"
                            name="joining_date"
                            class="form-control"
                            value="{{ old('joining_date', optional($employee->joining_date)->format('Y-m-d')) }}"
                        >
                    </div>

                </div>

                <button type="submit" class="btn btn-primary">
                    Update Employee
                </button>

            </form>

        </div>
    </div>

</div>

</body>
</html>
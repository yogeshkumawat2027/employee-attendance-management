@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="page-title mb-1">
            Add Employee
        </h2>

        <p class="page-subtitle mb-0">
            Create a new employee account
        </p>
    </div>

    <a
        href="{{ route('employees.index') }}"
        class="btn btn-outline-secondary"
    >
        Back
    </a>

</div>

<div class="card shadow-sm">

    <div class="card-body p-4">

        <form
            action="{{ route('employees.store') }}"
            method="POST"
        >

            @csrf

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Employee Code
                    </label>

                    <input
                        type="text"
                        name="employee_code"
                        class="form-control"
                        value="{{ old('employee_code') }}"
                        required
                    >

                    @error('employee_code')
                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Full Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="{{ old('name') }}"
                        required
                    >

                    @error('name')
                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email') }}"
                        required
                    >

                    @error('email')
                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Phone
                    </label>

                    <input
                        type="text"
                        name="phone"
                        class="form-control"
                        value="{{ old('phone') }}"
                    >

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Department
                    </label>

                    <input
                        type="text"
                        name="department"
                        class="form-control"
                        value="{{ old('department') }}"
                    >

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Designation
                    </label>

                    <input
                        type="text"
                        name="designation"
                        class="form-control"
                        value="{{ old('designation') }}"
                    >

                </div>

                <div class="col-md-6 mb-4">

                    <label class="form-label">
                        Joining Date
                    </label>

                    <input
                        type="date"
                        name="joining_date"
                        class="form-control"
                        value="{{ old('joining_date') }}"
                    >

                </div>

            </div>

            <div class="alert alert-info">
                Default employee password will be
                <strong>password123</strong>.
            </div>

            <button
                type="submit"
                class="btn btn-primary"
            >
                Create Employee
            </button>

        </form>

    </div>

</div>

@endsection
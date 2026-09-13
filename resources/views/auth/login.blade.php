<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Login - Attendance Management</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>

        body {
            min-height: 100vh;
            background: #f5f7fb;
        }

        .login-card {
            border: 0;
            border-radius: 16px;
        }

    </style>

</head>

<body>

<div class="container">

    <div class="row justify-content-center align-items-center min-vh-100">

        <div class="col-sm-10 col-md-6 col-lg-4">

            <div class="card login-card shadow-sm">

                <div class="card-body p-4 p-md-5">

                    <div class="text-center mb-4">

                        <h3 class="fw-bold">
                            Attendance Management
                        </h3>

                        <p class="text-muted mb-0">
                            Sign in to continue
                        </p>

                    </div>

                    @if($errors->any())

                        <div class="alert alert-danger">

                            {{ $errors->first() }}

                        </div>

                    @endif

                    <form
                        action="{{ route('login.submit') }}"
                        method="POST"
                    >

                        @csrf

                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Email
                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                value="{{ old('email') }}"
                                placeholder="Enter your email"
                                required
                                autofocus
                            >

                        </div>

                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Password
                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                placeholder="Enter your password"
                                required
                            >

                        </div>

                        <button
                            type="submit"
                            class="btn btn-primary w-100"
                        >
                            Login
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>
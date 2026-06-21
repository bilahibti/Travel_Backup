<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <title>Login - TravelTime</title>
        <meta name="description" content="" />

        <!-- Favicons -->
        <link href="{{ asset('frontend/img/favicon.png')}}" rel="icon" />
        <link href="{{ asset('frontend/img/apple-touch-icon.png')}}" rel="apple-touch-icon" />

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com" rel="preconnect" />
        <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

        <!-- Vendor CSS -->
        <link href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" />
        <link href="{{ asset('frontend/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet" />

        <!-- Main CSS -->
        <link href="{{ asset('frontend/css/main.css')}}" rel="stylesheet" />
        <link href="{{ asset('frontend/css/theme-redesign.css')}}" rel="stylesheet" />

        <style>
            body {
                font-family: 'Poppins', sans-serif;
                background-color: #f5f3ff;
            }

            .auth-page {
                min-height: 100vh;
                display: flex;
                align-items: center;
                background-color: #f5f3ff;
                padding: 100px 0 60px;
            }

            .auth-card {
                background: #fff;
                border-radius: 20px;
                box-shadow: 0 8px 40px rgba(109, 40, 217, 0.12);
                overflow: hidden;
                max-width: 460px;
                width: 100%;
                margin: 0 auto;
            }

            .auth-card-header {
                background: linear-gradient(135deg, #6d28d9, #9333ea);
                padding: 36px 40px 28px;
                text-align: center;
                color: #fff;
            }

            .auth-card-header .brand-icon {
                width: 52px;
                height: 52px;
                background: rgba(255,255,255,0.2);
                border-radius: 14px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 14px;
                font-size: 1.5rem;
            }

            .auth-card-header .sitename {
                font-size: 1.6rem;
                font-weight: 700;
                letter-spacing: 0.5px;
            }

            .auth-card-header p {
                margin: 6px 0 0;
                opacity: 0.85;
                font-size: 0.875rem;
            }

            .auth-card-body {
                padding: 36px 40px 40px;
            }

            .form-label {
                font-weight: 500;
                color: #374151;
                font-size: 0.875rem;
                margin-bottom: 6px;
            }

            .form-control {
                border-radius: 10px;
                padding: 11px 14px;
                border: 1.5px solid #e5e7eb;
                font-size: 0.9rem;
                transition: border-color 0.2s, box-shadow 0.2s;
                font-family: 'Poppins', sans-serif;
            }

            .form-control:focus {
                border-color: #7c3aed;
                box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.12);
                outline: none;
            }

            .input-group .form-control {
                border-right: 0;
                border-radius: 10px 0 0 10px;
            }

            .input-group-text {
                background: #fff;
                border: 1.5px solid #e5e7eb;
                border-left: 0;
                border-radius: 0 10px 10px 0;
                cursor: pointer;
                color: #9ca3af;
                transition: color 0.2s;
            }

            .input-group-text:hover {
                color: #7c3aed;
            }

            .btn-auth {
                background: linear-gradient(135deg, #6d28d9, #9333ea);
                color: #fff;
                border: none;
                border-radius: 10px;
                padding: 13px;
                font-weight: 600;
                font-size: 0.95rem;
                width: 100%;
                transition: opacity 0.2s, transform 0.15s;
                font-family: 'Poppins', sans-serif;
                letter-spacing: 0.3px;
            }

            .btn-auth:hover {
                opacity: 0.9;
                transform: translateY(-1px);
                color: #fff;
            }

            .divider-text {
                display: flex;
                align-items: center;
                gap: 12px;
                color: #9ca3af;
                font-size: 0.8rem;
                margin: 22px 0;
            }

            .divider-text::before,
            .divider-text::after {
                content: '';
                flex: 1;
                height: 1px;
                background: #e5e7eb;
            }

            .btn-google {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
                border: 1.5px solid #e5e7eb;
                background: #fff;
                border-radius: 10px;
                padding: 11px;
                font-size: 0.875rem;
                font-weight: 500;
                color: #374151;
                width: 100%;
                text-decoration: none;
                transition: background 0.2s, border-color 0.2s;
                font-family: 'Poppins', sans-serif;
            }

            .btn-google:hover {
                background: #faf5ff;
                border-color: #c4b5fd;
                color: #374151;
            }

            .auth-link {
                color: #7c3aed;
                font-weight: 600;
                text-decoration: none;
            }

            .auth-link:hover {
                color: #5b21b6;
                text-decoration: underline;
            }

            .form-check-input:checked {
                background-color: #7c3aed;
                border-color: #7c3aed;
            }

            .form-check-input:focus {
                box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.15);
            }

            .alert-danger {
                border-radius: 10px;
                font-size: 0.875rem;
                background-color: #fef2f2;
                border: 1px solid #fecaca;
                color: #dc2626;
            }

            .alert-success {
                border-radius: 10px;
                font-size: 0.875rem;
                background-color: #f0fdf4;
                border: 1px solid #bbf7d0;
                color: #16a34a;
            }
        </style>
    </head>

    <body>
        <!-- Navbar -->
        <header id="header" class="header d-flex align-items-center fixed-top">
            <div class="container position-relative d-flex align-items-center justify-content-between">
                <a href="{{ route('v1.frontend.dashboard') }}" class="logo d-flex align-items-center me-auto me-xl-0">
                    <h1 class="sitename">TravelTime</h1>
                </a>
                <nav id="navmenu" class="navmenu">
                    <ul>
                        <li><a href="{{ route('v1.frontend.dashboard') }}">Home</a></li>
                        <li><a href="{{ route('v1.frontend.destination') }}">Destinations</a></li>
                        <li><a href="{{ route('v1.frontend.tours') }}">Tours</a></li>
                        <li><a href="{{ route('v1.frontend.hotel') }}">Hotels</a></li>
                    </ul>
                    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
                </nav>
                <a class="btn-getstarted" href="{{ route('v1.frontend.login.register') }}">Register</a>
            </div>
        </header>

        <!-- Auth Section -->
        <div class="auth-page">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="auth-card">
                            <!-- Header -->
                            <div class="auth-card-header">
                                <div class="brand-icon">
                                    <i class="bi bi-airplane-fill"></i>
                                </div>
                                <div class="sitename">TravelTime</div>
                                <p>Sign in to start your adventure</p>
                            </div>

                            <!-- Body -->
                            <div class="auth-card-body">

                                @if(session()->has('error'))
                                <div class="alert alert-danger d-flex align-items-center gap-2 mb-4" role="alert">
                                    <i class="bi bi-exclamation-triangle-fill"></i>
                                    <span>{{ session('error') }}</span>
                                </div>
                                @endif

                                @if(session()->has('success'))
                                <div class="alert alert-success d-flex align-items-center gap-2 mb-4" role="alert">
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span>{{ session('success') }}</span>
                                </div>
                                @endif

                                <form action="{{ route('v1.frontend.login.process') }}" method="POST">
                                    @csrf

                                    <!-- Email -->
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input
                                            type="email"
                                            id="email"
                                            name="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            placeholder="your@email.com"
                                            value="{{ old('email') }}"
                                            required
                                            autofocus
                                        />
                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Password -->
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <label for="password" class="form-label mb-0">Password</label>
                                            <a href="#" class="auth-link" style="font-size:0.8rem;">Forgot password?</a>
                                        </div>
                                        <div class="input-group">
                                            <input
                                                type="password"
                                                id="password"
                                                name="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                placeholder="Enter your password"
                                                required
                                            />
                                            <span class="input-group-text" id="togglePassword">
                                                <i class="bi bi-eye-slash" id="toggleIcon"></i>
                                            </span>
                                            @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Remember Me -->
                                    <div class="mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" />
                                            <label class="form-check-label text-muted" for="remember" style="font-size:0.875rem;">
                                                Remember me
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Submit -->
                                    <button type="submit" class="btn-auth mb-3">
                                        <i class="bi bi-box-arrow-in-right me-2"></i>Sign In
                                    </button>

                                    <!-- Divider -->
                                    <div class="divider-text">or continue with</div>

                                    <!-- Google Login -->
                                    <a href="{{ url('/auth/google') }}" class="btn-google mb-4">
                                        <img src="https://cdn-icons-png.flaticon.com/512/281/281764.png" width="18" alt="Google">
                                        Continue with Google
                                    </a>

                                    <!-- Register link -->
                                    <p class="text-center text-muted mb-0" style="font-size:0.875rem;">
                                        Don't have an account?
                                        <a href="{{ route('v1.frontend.login.register') }}" class="auth-link">Create one</a>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vendor JS -->
        <script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{ asset('frontend/js/main.js')}}"></script>

        <script>
            document.getElementById('togglePassword').addEventListener('click', function () {
                const input = document.getElementById('password');
                const icon = document.getElementById('toggleIcon');
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.className = 'bi bi-eye';
                } else {
                    input.type = 'password';
                    icon.className = 'bi bi-eye-slash';
                }
            });
        </script>
    </body>
</html>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <title>Register - TravelTime</title>
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
            :root {
                --color-primary: #7c3aed;
                --color-secondary: #9333ea;
            }

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
                max-width: 500px;
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

            .password-strength {
                height: 4px;
                border-radius: 4px;
                background: #ede9fe;
                margin-top: 8px;
                overflow: hidden;
            }

            .password-strength-bar {
                height: 100%;
                border-radius: 4px;
                transition: width 0.3s, background 0.3s;
                width: 0%;
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

            .section-divider {
                font-size: 0.75rem;
                font-weight: 600;
                color: #7c3aed;
                text-transform: uppercase;
                letter-spacing: 0.8px;
                margin-bottom: 14px;
                padding-bottom: 8px;
                border-bottom: 1px solid #ede9fe;
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
                <a class="btn-getstarted" href="{{ route('v1.frontend.login.login') }}">Login</a>
            </div>
        </header>

        <!-- Auth Section -->
        <div class="auth-page">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-7 col-xl-6">
                        <div class="auth-card">
                            <!-- Header -->
                            <div class="auth-card-header">
                                <div class="brand-icon">
                                    <i class="bi bi-person-plus-fill"></i>
                                </div>
                                <div class="sitename">TravelTime</div>
                                <p>Create your account and start exploring the world</p>
                            </div>

                            <!-- Body -->
                            <div class="auth-card-body">

                                @if($errors->any())
                                <div class="alert alert-danger mb-4" role="alert">
                                    <ul class="mb-0 ps-3">
                                        @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif

                                <form action="{{ route('v1.frontend.login.register.process') }}" method="POST">
                                    @csrf

                                    <div class="section-divider">Personal Information</div>

                                    <!-- Name -->
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Full Name</label>
                                        <input
                                            type="text"
                                            id="name"
                                            name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Your full name"
                                            value="{{ old('name') }}"
                                            required
                                            autofocus
                                        />
                                        @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

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
                                        />
                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Phone -->
                                    <div class="mb-4">
                                        <label for="hp" class="form-label">
                                            Phone Number
                                            <span class="text-muted fw-normal">(optional)</span>
                                        </label>
                                        <input
                                            type="text"
                                            id="hp"
                                            name="hp"
                                            class="form-control @error('hp') is-invalid @enderror"
                                            placeholder="+62 812 3456 7890"
                                            value="{{ old('hp') }}"
                                        />
                                        @error('hp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="section-divider">Account Security</div>

                                    <!-- Password -->
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group">
                                            <input
                                                type="password"
                                                id="password"
                                                name="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                placeholder="Min. 8 characters"
                                                required
                                            />
                                            <span class="input-group-text" id="togglePassword">
                                                <i class="bi bi-eye-slash" id="toggleIcon"></i>
                                            </span>
                                            @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="password-strength">
                                            <div class="password-strength-bar" id="strengthBar"></div>
                                        </div>
                                        <div id="strengthText" class="mt-1" style="font-size:0.75rem; color:#888;"></div>
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="mb-4">
                                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                                        <div class="input-group">
                                            <input
                                                type="password"
                                                id="password_confirmation"
                                                name="password_confirmation"
                                                class="form-control"
                                                placeholder="Re-enter your password"
                                                required
                                            />
                                            <span class="input-group-text" id="toggleConfirm">
                                                <i class="bi bi-eye-slash" id="toggleConfirmIcon"></i>
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Terms -->
                                    <div class="mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="terms" required />
                                            <label class="form-check-label text-muted" for="terms" style="font-size:0.875rem;">
                                                I agree to the
                                                <a href="#" class="auth-link">Terms of Service</a>
                                                and
                                                <a href="#" class="auth-link">Privacy Policy</a>
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Submit -->
                                    <button type="submit" class="btn-auth mb-4">
                                        <i class="bi bi-person-plus me-2"></i>Create Account
                                    </button>

                                    <!-- Login link -->
                                    <p class="text-center text-muted mb-0" style="font-size:0.875rem;">
                                        Already have an account?
                                        <a href="{{ route('v1.frontend.login.login') }}" class="auth-link">Sign in here</a>
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

            document.getElementById('toggleConfirm').addEventListener('click', function () {
                const input = document.getElementById('password_confirmation');
                const icon = document.getElementById('toggleConfirmIcon');
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.className = 'bi bi-eye';
                } else {
                    input.type = 'password';
                    icon.className = 'bi bi-eye-slash';
                }
            });

            document.getElementById('password').addEventListener('input', function () {
                const val = this.value;
                const bar = document.getElementById('strengthBar');
                const text = document.getElementById('strengthText');
                let strength = 0;

                if (val.length >= 8) strength++;
                if (/[A-Z]/.test(val)) strength++;
                if (/[0-9]/.test(val)) strength++;
                if (/[^A-Za-z0-9]/.test(val)) strength++;

                const levels = [
                    { width: '0%', color: '#e0e0e0', label: '' },
                    { width: '25%', color: '#e53e3e', label: 'Weak' },
                    { width: '50%', color: '#dd6b20', label: 'Fair' },
                    { width: '75%', color: '#d69e2e', label: 'Good' },
                    { width: '100%', color: '#38a169', label: 'Strong' },
                ];

                const level = levels[strength];
                bar.style.width = level.width;
                bar.style.background = level.color;
                text.textContent = level.label ? `Password strength: ${level.label}` : '';
                text.style.color = level.color;
            });
        </script>
    </body>
</html>

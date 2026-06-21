<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <title>@yield('title', 'TravelTime') &mdash; Explore the World</title>
        <meta name="description" content="Discover destinations, hotels, transportation and curated travel packages." />

        <!-- Favicons -->
        <link href="{{ asset('frontend/img/favicon.png')}}" rel="icon" />
        <link href="{{ asset('frontend/img/apple-touch-icon.png')}}" rel="apple-touch-icon" />

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com" rel="preconnect" />
        <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@400;500;600;700;800&display=swap"
            rel="stylesheet"
        />

        <!-- Vendor CSS Files -->
        <link href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" />
        <link href="{{ asset('frontend/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet" />
        <link href="{{ asset('frontend/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet" />
        <link href="{{ asset('frontend/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet" />

        <!-- Main CSS File -->
        <link href="{{ asset('frontend/css/main.css')}}" rel="stylesheet" />
        <!-- Theme Redesign Overrides -->
        <link href="{{ asset('frontend/css/theme-redesign.css')}}" rel="stylesheet" />

        @stack('styles')
    </head>

    <body class="index-page">

        {{-- ============ HEADER ============ --}}
        <header id="header" class="header d-flex align-items-center fixed-top">
            <div class="container position-relative d-flex align-items-center justify-content-between">
                <a href="{{ route('v1.frontend.dashboard') }}" class="logo d-flex align-items-center me-auto me-xl-0">
                    <h1 class="sitename">TravelTime</h1>
                </a>

                <nav id="navmenu" class="navmenu">
                    <ul>
                        <li><a href="{{ route('v1.frontend.dashboard') }}" class="{{ request()->routeIs('v1.frontend.dashboard') ? 'active' : '' }}">Home</a></li>
                        <li><a href="{{ route('v1.frontend.about') }}" class="{{ request()->routeIs('v1.frontend.about') ? 'active' : '' }}">About</a></li>
                        <li><a href="{{ route('v1.frontend.destination') }}" class="{{ request()->routeIs('v1.frontend.destination*') ? 'active' : '' }}">Destinations</a></li>
                        <li><a href="{{ route('v1.frontend.hotel') }}" class="{{ request()->routeIs('v1.frontend.hotel*') ? 'active' : '' }}">Hotels</a></li>
                        <li><a href="{{ route('v1.frontend.transportation') }}" class="{{ request()->routeIs('v1.frontend.transportation*') ? 'active' : '' }}">Transportation</a></li>
                        <li><a href="{{ route('v1.frontend.tours') }}" class="{{ request()->routeIs('v1.frontend.tours*') ? 'active' : '' }}">Travel Packages</a></li>
                    </ul>
                    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
                </nav>

                @auth
                    <div class="dropdown">
                        <a href="#" class="btn-getstarted dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-1"></i>{{ Auth::user()->name ?? 'My Account' }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('v1.booking.index') }}"><i class="bi bi-bag-check me-2"></i>My Bookings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('v1.frontend.login.logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger"><i class="bi bi-box-arrow-right me-2"></i>Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a class="btn-getstarted" href="{{ route('v1.frontend.login.login') }}">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Login
                    </a>
                @endauth
            </div>
        </header>

        <main class="main">
            @if(session('success'))
                <div class="container mt-5 pt-5">
                    <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                </div>
            @endif

            @yield('content')
        </main>

        {{-- ============ FOOTER ============ --}}
        <footer id="footer" class="footer dark-background">
            <div class="container footer-top">
                <div class="row gy-4">
                    <div class="col-lg-4 col-md-6 footer-about">
                        <a href="{{ route('v1.frontend.dashboard') }}" class="logo d-flex align-items-center">
                            <span class="sitename">TravelTime</span>
                        </a>
                        <p class="mt-3">
                            Your trusted companion for unforgettable journeys — curated destinations,
                            handpicked hotels, reliable transportation, and all-in-one travel packages.
                        </p>
                        <div class="social-links d-flex mt-4">
                            <a href="#"><i class="bi bi-facebook"></i></a>
                            <a href="#"><i class="bi bi-instagram"></i></a>
                            <a href="#"><i class="bi bi-twitter-x"></i></a>
                            <a href="#"><i class="bi bi-youtube"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-2 col-6 footer-links">
                        <h4>Explore</h4>
                        <ul>
                            <li><a href="{{ route('v1.frontend.destination') }}"><i class="bi bi-chevron-right"></i> Destinations</a></li>
                            <li><a href="{{ route('v1.frontend.hotel') }}"><i class="bi bi-chevron-right"></i> Hotels</a></li>
                            <li><a href="{{ route('v1.frontend.transportation') }}"><i class="bi bi-chevron-right"></i> Transportation</a></li>
                            <li><a href="{{ route('v1.frontend.tours') }}"><i class="bi bi-chevron-right"></i> Travel Packages</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-2 col-6 footer-links">
                        <h4>Company</h4>
                        <ul>
                            <li><a href="{{ route('v1.frontend.about') }}"><i class="bi bi-chevron-right"></i> About Us</a></li>
                            <li><a href="{{ route('v1.frontend.login.login') }}"><i class="bi bi-chevron-right"></i> Login</a></li>
                            <li><a href="{{ route('v1.frontend.login.register') }}"><i class="bi bi-chevron-right"></i> Register</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-4 col-md-6 footer-contact text-md-start">
                        <h4>Get in Touch</h4>
                        <p><i class="bi bi-geo-alt me-2"></i>2847 Maple Avenue, Los Angeles, CA 90210</p>
                        <p><i class="bi bi-telephone me-2"></i>+1 (555) 987-6543</p>
                        <p><i class="bi bi-envelope me-2"></i>contact@traveltime.example</p>
                    </div>
                </div>
            </div>

            <div class="container copyright text-center mt-4">
                <p>© <span>Copyright</span> <strong class="px-1 sitename">TravelTime</strong> <span>All Rights Reserved</span></p>
            </div>
        </footer>

        <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
        <div id="preloader"></div>

        <!-- Vendor JS Files -->
        <script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{ asset('frontend/vendor/php-email-form/validate.js')}}"></script>
        <script src="{{ asset('frontend/vendor/purecounter/purecounter_vanilla.js')}}"></script>
        <script src="{{ asset('frontend/vendor/swiper/swiper-bundle.min.js')}}"></script>
        <script src="{{ asset('frontend/vendor/glightbox/js/glightbox.min.js')}}"></script>
        <script src="{{ asset('frontend/vendor/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
        <script src="{{ asset('frontend/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>

        <!-- Main JS File -->
        <script src="{{ asset('frontend/js/main.js')}}"></script>

        @stack('scripts')
    </body>
</html>

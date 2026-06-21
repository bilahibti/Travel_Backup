@extends('frontend.v_layouts.app')

@section('title', 'About Us')

@section('content')

<section class="page-hero">
    <div class="container">
        <h1>About TravelTime</h1>
        <p class="breadcrumb-trail mb-0">
            <a href="{{ route('v1.frontend.dashboard') }}">Home</a> / <span>About</span>
        </p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <span class="section-badge">Our Story</span>
                <h2 class="section-title">We Make Travel Planning Effortless</h2>
                <p class="text-muted">
                    TravelTime brings destinations, hotels, transportation and curated travel packages together
                    in one platform, so you can plan your entire trip without juggling a dozen different apps
                    and websites.
                </p>
                <p class="text-muted">
                    From hidden local gems to iconic landmarks, our team works with trusted partners across
                    every destination to make sure your journey is safe, comfortable and unforgettable.
                </p>
                <div class="row g-3 mt-3">
                    <div class="col-sm-6 d-flex gap-2"><i class="bi bi-check-circle-fill text-success"></i> Trusted local partners</div>
                    <div class="col-sm-6 d-flex gap-2"><i class="bi bi-check-circle-fill text-success"></i> All-in-one packages</div>
                    <div class="col-sm-6 d-flex gap-2"><i class="bi bi-check-circle-fill text-success"></i> Transparent pricing</div>
                    <div class="col-sm-6 d-flex gap-2"><i class="bi bi-check-circle-fill text-success"></i> 24/7 support</div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row g-3">
                    <div class="col-6"><img src="{{ asset('frontend/img/travel/destination-12.webp') }}" class="img-fluid rounded-4 shadow" alt=""></div>
                    <div class="col-6 pt-5"><img src="{{ asset('frontend/img/travel/destination-13.webp') }}" class="img-fluid rounded-4 shadow" alt=""></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section light-background">
    <div class="container">
        <div class="row g-4 text-center">
            <div class="col-md-3 col-6">
                <div class="tt-card p-4 h-100">
                    <i class="bi bi-globe-americas fs-1 text-success"></i>
                    <h3 class="mt-3 mb-0">120+</h3>
                    <p class="text-muted mb-0">Destinations</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="tt-card p-4 h-100">
                    <i class="bi bi-building fs-1 text-success"></i>
                    <h3 class="mt-3 mb-0">85+</h3>
                    <p class="text-muted mb-0">Partner Hotels</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="tt-card p-4 h-100">
                    <i class="bi bi-emoji-smile fs-1 text-success"></i>
                    <h3 class="mt-3 mb-0">15K+</h3>
                    <p class="text-muted mb-0">Happy Travelers</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="tt-card p-4 h-100">
                    <i class="bi bi-suitcase-lg fs-1 text-success"></i>
                    <h3 class="mt-3 mb-0">50+</h3>
                    <p class="text-muted mb-0">Travel Packages</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="cta-banner text-center">
            <h2 class="mb-3">Let's plan your next trip together</h2>
            <p class="mb-4 opacity-75">Browse destinations, hotels, transportation and packages tailored for you.</p>
            <a href="{{ route('v1.frontend.tours') }}" class="btn btn-accent">Explore Travel Packages</a>
        </div>
    </div>
</section>

@endsection

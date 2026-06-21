@extends('frontend.v_layouts.app')

@section('title', $package->packages_name)

@section('content')

<section class="page-hero">
    <div class="container">
        <h1>{{ $package->packages_name }}</h1>
        <p class="breadcrumb-trail mb-0">
            <a href="{{ route('v1.frontend.dashboard') }}">Home</a> /
            <a href="{{ route('v1.frontend.tours') }}">Travel Packages</a> /
            <span>{{ $package->packages_name }}</span>
        </p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-7">
                <img src="{{ $package->foto ? asset('storage/img-package/'.$package->foto) : asset('frontend/img/travel/destination-11.webp') }}"
                     class="img-fluid rounded-4 shadow mb-4 w-100" style="max-height:420px;object-fit:cover;" alt="{{ $package->packages_name }}">

                <div class="d-flex flex-wrap gap-2 mb-4">
                    <span class="status-pill {{ $package->status == 'Available' ? 'available' : 'full' }}">{{ $package->status }}</span>
                    <span class="status-pill" style="background:#eef3f2;color:#0e2a2e;">{{ $package->package_type }}</span>
                    <span class="status-pill" style="background:#eef3f2;color:#0e2a2e;"><i class="bi bi-calendar3"></i> {{ $package->duration_days ?? '-' }} days</span>
                    <span class="status-pill" style="background:#eef3f2;color:#0e2a2e;"><i class="bi bi-people"></i> Max {{ $package->max_persons ?? '-' }} pax</span>
                </div>

                <h3 class="mb-3">Package Overview</h3>
                <p class="text-muted">{{ $package->description }}</p>

                <div class="row g-4 mt-1">
                    @if($package->include)
                    <div class="col-md-6">
                        <h5 class="mb-3">What's Included</h5>
                        <ul class="list-unstyled incl-list">
                            @foreach(explode("\n", trim($package->include)) as $line)
                                @if(trim($line) !== '')
                                <li><i class="bi bi-check-circle-fill"></i> {{ trim($line, "- \t") }}</li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if($package->exclude)
                    <div class="col-md-6">
                        <h5 class="mb-3">Not Included</h5>
                        <ul class="list-unstyled excl-list">
                            @foreach(explode("\n", trim($package->exclude)) as $line)
                                @if(trim($line) !== '')
                                <li><i class="bi bi-x-circle-fill"></i> {{ trim($line, "- \t") }}</li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>

                {{-- Bundled components --}}
                <h3 class="mt-5 mb-3">What's Bundled in This Package</h3>
                <div class="row g-3">
                    @if($package->destination)
                    <div class="col-md-4">
                        <div class="tt-card p-3 h-100">
                            <i class="bi bi-geo-alt-fill text-success fs-4"></i>
                            <h6 class="mt-2 mb-1">Destination</h6>
                            <p class="small text-muted mb-2">{{ $package->destination->destination_name }}, {{ $package->destination->city }}</p>
                            <a href="{{ route('v1.frontend.destination.show', $package->destination->id) }}" class="small fw-semibold">View destination</a>
                        </div>
                    </div>
                    @endif
                    @if($package->hotel)
                    <div class="col-md-4">
                        <div class="tt-card p-3 h-100">
                            <i class="bi bi-building text-success fs-4"></i>
                            <h6 class="mt-2 mb-1">Hotel</h6>
                            <p class="small text-muted mb-2">{{ $package->hotel->hotel_name }} ({{ $package->hotel->star_rating }}★)</p>
                            <a href="{{ route('v1.frontend.hotel.show', $package->hotel->id) }}" class="small fw-semibold">View hotel</a>
                        </div>
                    </div>
                    @endif
                    @if($package->transportation)
                    <div class="col-md-4">
                        <div class="tt-card p-3 h-100">
                            <i class="bi bi-airplane-fill text-success fs-4"></i>
                            <h6 class="mt-2 mb-1">Transportation</h6>
                            <p class="small text-muted mb-2">{{ $package->transportation->transportation_name }}</p>
                            <a href="{{ route('v1.frontend.transportation.show', $package->transportation->id) }}" class="small fw-semibold">View transport</a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <div class="col-lg-5">
                <div class="tt-card p-4" style="position:sticky; top:110px;">
                    <h5 class="mb-1">Total Price</h5>
                    <div class="display-6 fw-bold text-success mb-3">Rp {{ number_format($package->price_packages, 0, ',', '.') }}<small class="fs-6 text-muted">/person</small></div>
                    <ul class="list-unstyled mb-4">
                        <li class="d-flex justify-content-between py-2 border-bottom"><span class="text-muted">Duration</span><strong>{{ $package->duration_days ?? '-' }} days</strong></li>
                        <li class="d-flex justify-content-between py-2 border-bottom"><span class="text-muted">Max Persons</span><strong>{{ $package->max_persons ?? '-' }}</strong></li>
                        <li class="d-flex justify-content-between py-2"><span class="text-muted">Remaining Quota</span><strong>{{ max($package->quota - ($package->booked ?? 0), 0) }}</strong></li>
                    </ul>
                    @auth
                        <a href="{{ route('v1.booking.package.create', $package->id) }}" class="btn btn-primary w-100">Book This Package</a>
                    @else
                        <a href="{{ route('v1.frontend.login.login') }}" class="btn btn-primary w-100">Login to Book</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

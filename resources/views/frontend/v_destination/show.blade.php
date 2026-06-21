@extends('frontend.v_layouts.app')

@section('title', $destination->destination_name)

@section('content')

<section class="page-hero">
    <div class="container">
        <h1>{{ $destination->destination_name }}</h1>
        <p class="breadcrumb-trail mb-0">
            <a href="{{ route('v1.frontend.dashboard') }}">Home</a> /
            <a href="{{ route('v1.frontend.destination') }}">Destinations</a> /
            <span>{{ $destination->destination_name }}</span>
        </p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-7">
                <img src="{{ $destination->foto ? asset('storage/img-destination/'.$destination->foto) : asset('frontend/img/travel/destination-4.webp') }}"
                     class="img-fluid rounded-4 shadow mb-4 w-100" style="max-height:420px;object-fit:cover;" alt="{{ $destination->destination_name }}">

                <div class="d-flex flex-wrap gap-2 mb-4">
                    <span class="status-pill {{ $destination->status == 'Available' ? 'available' : 'full' }}">{{ $destination->status }}</span>
                    <span class="status-pill" style="background:#eef3f2;color:#0e2a2e;">{{ $destination->destination_type }}</span>
                    <span class="status-pill" style="background:#eef3f2;color:#0e2a2e;"><i class="bi bi-geo-alt"></i> {{ $destination->city }}, {{ $destination->country }}</span>
                </div>

                <h3 class="mb-3">About this destination</h3>
                <p class="text-muted">{{ $destination->description }}</p>
            </div>

            <div class="col-lg-5">
                <div class="tt-card p-4">
                    <h5 class="mb-3">Trip Snapshot</h5>
                    <ul class="list-unstyled mb-0">
                        <li class="d-flex justify-content-between py-2 border-bottom"><span class="text-muted">Country</span><strong>{{ $destination->country }}</strong></li>
                        <li class="d-flex justify-content-between py-2 border-bottom"><span class="text-muted">City</span><strong>{{ $destination->city }}</strong></li>
                        <li class="d-flex justify-content-between py-2 border-bottom"><span class="text-muted">Type</span><strong>{{ $destination->destination_type }}</strong></li>
                        <li class="d-flex justify-content-between py-2"><span class="text-muted">Remaining Quota</span><strong>{{ max($destination->quota - ($destination->booked ?? 0), 0) }}</strong></li>
                    </ul>
                </div>
            </div>
        </div>

        @if(($packages ?? collect())->isNotEmpty())
        <div class="mt-5 pt-4">
            <h3 class="section-title">Travel Packages to {{ $destination->destination_name }}</h3>
            <div class="row g-4 mt-1">
                @foreach($packages as $pkg)
                    <div class="col-lg-4 col-md-6">
                        <div class="tt-card">
                            <div class="tt-card-img">
                                <img src="{{ $pkg->foto ? asset('storage/img-package/'.$pkg->foto) : asset('frontend/img/travel/destination-6.webp') }}" alt="{{ $pkg->packages_name }}">
                                <span class="tt-card-price">${{ number_format($pkg->price_packages, 0) }}</span>
                            </div>
                            <div class="tt-card-body">
                                <h5>{{ $pkg->packages_name }}</h5>
                                <p class="desc">{{ Str::limit($pkg->description, 80) }}</p>
                                <div class="tt-card-foot">
                                    <span class="status-pill {{ $pkg->status == 'Available' ? 'available' : 'full' }}">{{ $pkg->status }}</span>
                                    <a href="{{ route('v1.frontend.tours.show', $pkg->id) }}" class="fw-semibold">Details <i class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        @if(($hotels ?? collect())->isNotEmpty())
        <div class="mt-5 pt-4">
            <h3 class="section-title">Hotels in {{ $destination->city }}</h3>
            <div class="row g-4 mt-1">
                @foreach($hotels as $hotel)
                    <div class="col-lg-4 col-md-6">
                        <div class="tt-card">
                            <div class="tt-card-img">
                                <img src="{{ $hotel->foto ? asset('storage/img-hotel/'.$hotel->foto) : asset('frontend/img/travel/destination-8.webp') }}" alt="{{ $hotel->hotel_name }}">
                                <span class="tt-card-price">${{ number_format($hotel->price_per_night, 0) }}/night</span>
                            </div>
                            <div class="tt-card-body">
                                <h5>{{ $hotel->hotel_name }}</h5>
                                <div class="tt-card-foot border-0 pt-0 mt-0">
                                    <span class="stars">
                                        @for($i=0;$i<$hotel->star_rating;$i++)<i class="bi bi-star-fill"></i>@endfor
                                    </span>
                                    <a href="{{ route('v1.frontend.hotel.show', $hotel->id) }}" class="fw-semibold">Details <i class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>

@endsection

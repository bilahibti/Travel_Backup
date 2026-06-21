@extends('frontend.v_layouts.app')

@section('title', $hotel->hotel_name)

@section('content')

<section class="page-hero">
    <div class="container">
        <h1>{{ $hotel->hotel_name }}</h1>
        <p class="breadcrumb-trail mb-0">
            <a href="{{ route('v1.frontend.dashboard') }}">Home</a> /
            <a href="{{ route('v1.frontend.hotel') }}">Hotels</a> /
            <span>{{ $hotel->hotel_name }}</span>
        </p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-7">
                <img src="{{ $hotel->foto ? asset('storage/img-hotel/'.$hotel->foto) : asset('frontend/img/travel/destination-10.webp') }}"
                     class="img-fluid rounded-4 shadow mb-4 w-100" style="max-height:420px;object-fit:cover;" alt="{{ $hotel->hotel_name }}">

                <div class="d-flex flex-wrap gap-2 mb-4 align-items-center">
                    <span class="status-pill {{ $hotel->status == 'Available' ? 'available' : 'full' }}">{{ $hotel->status }}</span>
                    <span class="stars">
                        @for($i=0;$i<$hotel->star_rating;$i++)<i class="bi bi-star-fill"></i>@endfor
                    </span>
                    <span class="status-pill" style="background:#eef3f2;color:#0e2a2e;"><i class="bi bi-geo-alt"></i> {{ $hotel->destination->destination_name ?? '-' }}</span>
                </div>

                <h3 class="mb-3">About this hotel</h3>
                <p class="text-muted">{{ $hotel->description }}</p>

                <h5 class="mt-4 mb-2">Address</h5>
                <p class="text-muted"><i class="bi bi-geo-alt me-1"></i>{{ $hotel->address }}</p>

                <h5 class="mt-4 mb-2">Facilities</h5>
                <p class="text-muted">{{ $hotel->facilities }}</p>
            </div>

            <div class="col-lg-5">
                <div class="tt-card p-4">
                    <h5 class="mb-1">Price per night</h5>
                    <div class="display-6 fw-bold text-success mb-3">${{ number_format($hotel->price_per_night, 0) }}</div>
                    <ul class="list-unstyled mb-4">
                        <li class="d-flex justify-content-between py-2 border-bottom"><span class="text-muted">Destination</span><strong>{{ $hotel->destination->destination_name ?? '-' }}</strong></li>
                        <li class="d-flex justify-content-between py-2 border-bottom"><span class="text-muted">Star Rating</span><strong>{{ $hotel->star_rating }} / 5</strong></li>
                        <li class="d-flex justify-content-between py-2"><span class="text-muted">Remaining Quota</span><strong>{{ max($hotel->quota - ($hotel->booked ?? 0), 0) }}</strong></li>
                    </ul>
                    @auth
                        <a href="{{ route('v1.booking.hotel.create', $hotel->id) }}" class="btn btn-primary w-100">Book This Hotel</a>
                    @else
                        <a href="{{ route('v1.frontend.login.login') }}" class="btn btn-primary w-100">Login to Book</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

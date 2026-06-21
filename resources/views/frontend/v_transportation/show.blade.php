@extends('frontend.v_layouts.app')

@section('title', $transportation->transportation_name)

@section('content')

<section class="page-hero">
    <div class="container">
        <h1>{{ $transportation->transportation_name }}</h1>
        <p class="breadcrumb-trail mb-0">
            <a href="{{ route('v1.frontend.dashboard') }}">Home</a> /
            <a href="{{ route('v1.frontend.transportation') }}">Transportation</a> /
            <span>{{ $transportation->transportation_name }}</span>
        </p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="row g-5 justify-content-center">
            <div class="col-lg-7">
                <div class="tt-card p-4">
                    <span class="status-pill" style="background:var(--sand-color);color:var(--accent-color-2);">{{ $transportation->transportation_type }}</span>

                    <div class="d-flex align-items-center justify-content-between my-4 text-center">
                        <div>
                            <i class="bi bi-geo-alt fs-3 text-success"></i>
                            <h5 class="mt-2 mb-0">{{ $transportation->departureDestination->city ?? '-' }}</h5>
                            <small class="text-muted">{{ $transportation->departureDestination->country ?? '' }}</small>
                            <div class="mt-2 fw-semibold">{{ \Illuminate\Support\Carbon::parse($transportation->departure_time)->format('d M Y, H:i') }}</div>
                        </div>
                        <i class="bi bi-arrow-right-circle fs-1 text-muted"></i>
                        <div>
                            <i class="bi bi-geo-alt-fill fs-3 text-danger"></i>
                            <h5 class="mt-2 mb-0">{{ $transportation->arrivalDestination->city ?? '-' }}</h5>
                            <small class="text-muted">{{ $transportation->arrivalDestination->country ?? '' }}</small>
                            <div class="mt-2 fw-semibold">{{ \Illuminate\Support\Carbon::parse($transportation->arrival_time)->format('d M Y, H:i') }}</div>
                        </div>
                    </div>

                    <ul class="list-unstyled mb-4">
                        <li class="d-flex justify-content-between py-2 border-bottom"><span class="text-muted">Status</span><span class="status-pill {{ $transportation->status == 'Available' ? 'available' : 'full' }}">{{ $transportation->status }}</span></li>
                        <li class="d-flex justify-content-between py-2"><span class="text-muted">Remaining Quota</span><strong>{{ max($transportation->quota - ($transportation->booked ?? 0), 0) }}</strong></li>
                    </ul>

                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted d-block">Price per person</small>
                            <span class="display-6 fw-bold text-success">Rp {{ number_format($transportation->price_per_person, 0, ',', '.') }}</span>
                        </div>
                        @auth
                            <a href="{{ route('v1.booking.transport.create', $transportation->id) }}" class="btn btn-primary">Book Now</a>
                        @else
                            <a href="{{ route('v1.frontend.login.login') }}" class="btn btn-primary">Login to Book</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

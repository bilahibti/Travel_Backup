@extends('frontend.v_layouts.app')

@section('title', 'Booking Paket - ' . $package->packages_name)

@section('content')

<section class="page-hero">
    <div class="container">
        <h1>Booking Paket Wisata</h1>
        <p class="breadcrumb-trail mb-0">
            <a href="{{ route('v1.frontend.dashboard') }}">Home</a> /
            <a href="{{ route('v1.frontend.tours') }}">Tours</a> /
            <a href="{{ route('v1.frontend.tours.show', $package->id) }}">{{ $package->packages_name }}</a> /
            <span>Booking</span>
        </p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-7">
                <div class="tt-card p-4">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <h4 class="mb-4">Package Booking Form</h4>

                    <form action="{{ route('v1.booking.package') }}" method="POST">
                        @csrf
                        <input type="hidden" name="travel_package_id" value="{{ $package->id }}">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Departure Date</label>
                            <input type="date" name="travel_date" class="form-control" min="{{ now()->addDay()->format('Y-m-d') }}" value="{{ old('travel_date') }}" required>
                            <small class="text-muted">Package duration: {{ $package->duration_days }} days</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Number of Participants</label>
                            <input type="number" name="persons" class="form-control" min="1" max="{{ $package->max_persons }}" value="{{ old('persons', 1) }}" required>
                            <small class="text-muted">Maximum {{ $package->max_persons }} people per booking</small>
                        </div>

                        <hr class="my-4">
                        <h5 class="mb-3">Contact Information</h5>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Full Name</label>
                            <input type="text" name="contact_name" class="form-control" value="{{ old('contact_name', auth()->user()->name ?? '') }}" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Phone Number</label>
                                <input type="text" name="contact_phone" class="form-control" value="{{ old('contact_phone', auth()->user()->hp ?? '') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email" name="contact_email" class="form-control" value="{{ old('contact_email', auth()->user()->email ?? '') }}" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Notes (optional)</label>
                            <textarea name="notes" class="form-control" rows="3">{{ old('notes') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2">Continue to Payment</button>
                    </form>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="tt-card p-4">
                    <h5 class="mb-1">{{ $package->packages_name }}</h5>
                    <p class="text-muted mb-2"><i class="bi bi-geo-alt me-1"></i>{{ $package->destination->destination_name ?? '-' }}</p>
                    <ul class="list-unstyled">
                        <li class="d-flex justify-content-between py-2 border-bottom"><span class="text-muted">Price / person</span><strong>Rp {{ number_format($package->price_packages,0, ',', '.') }}</strong></li>
                        <li class="d-flex justify-content-between py-2 border-bottom"><span class="text-muted">Duration</span><strong>{{ $package->duration_days }} days</strong></li>
                        <li class="d-flex justify-content-between py-2"><span class="text-muted">Type</span><strong>{{ $package->package_type }}</strong></li>
                    </ul>
                    <p class="small text-muted mt-3 mb-0"><i class="bi bi-info-circle me-1"></i>Total price (including 11% tax) will be calculated automatically and displayed on the payment page.</p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

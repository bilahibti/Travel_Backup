@extends('frontend.v_layouts.app')

@section('title', 'Booking Transportasi - ' . $transport->transportation_name)

@section('content')

<section class="page-hero">
    <div class="container">
        <h1>Booking Transportasi</h1>
        <p class="breadcrumb-trail mb-0">
            <a href="{{ route('v1.frontend.dashboard') }}">Home</a> /
            <a href="{{ route('v1.frontend.transportation') }}">Transportation</a> /
            <a href="{{ route('v1.frontend.transportation.show', $transport->id) }}">{{ $transport->transportation_name }}</a> /
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

                    <h4 class="mb-4">Transportation Booking Form</h4>

                    <form action="{{ route('v1.booking.transport') }}" method="POST">
                        @csrf
                        <input type="hidden" name="transportation_id" value="{{ $transport->id }}">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Number of Passengers</label>
                            <input type="number" name="persons" class="form-control" min="1" max="{{ $transport->quota }}" value="{{ old('persons', 1) }}" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Departure Location</label>
                                <input type="text" name="pickup_location" class="form-control" value="{{ old('pickup_location', $transport->departure) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Arrival Location</label>
                                <input type="text" name="dropoff_location" class="form-control" value="{{ old('dropoff_location', $transport->arrival) }}">
                            </div>
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
                            <label class="form-label fw-semibold">Special Request (optional)</label>
                            <textarea name="special_request" class="form-control" rows="3">{{ old('special_request') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2">Continue to Payment</button>
                    </form>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="tt-card p-4">
                    <h5 class="mb-1">{{ $transport->transportation_name }}</h5>
                    <p class="text-muted mb-2">{{ $transport->transportation_type }}</p>
                    <ul class="list-unstyled">
                        <li class="d-flex justify-content-between py-2 border-bottom"><span class="text-muted">Rute</span><strong>{{ $transport->departure }} → {{ $transport->arrival }}</strong></li>
                        <li class="d-flex justify-content-between py-2 border-bottom"><span class="text-muted">Departure</span><strong>{{ \Carbon\Carbon::parse($transport->departure_time)->format('d M Y, H:i') }}</strong></li>
                        <li class="d-flex justify-content-between py-2"><span class="text-muted">Price / person</span><strong>Rp {{ number_format($transport->price_per_person,0, ',', '.') }}</strong></li>
                    </ul>
                    <p class="small text-muted mt-3 mb-0"><i class="bi bi-info-circle me-1"></i>Total price (including 11% tax) will be calculated automatically and displayed on the payment page.</p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

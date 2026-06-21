@extends('frontend.v_layouts.app')

@section('title', 'Booking Hotel - ' . $hotel->hotel_name)

@section('content')

<section class="page-hero">
    <div class="container">
        <h1>Booking Hotel</h1>
        <p class="breadcrumb-trail mb-0">
            <a href="{{ route('v1.frontend.dashboard') }}">Home</a> /
            <a href="{{ route('v1.frontend.hotel') }}">Hotels</a> /
            <a href="{{ route('v1.frontend.hotel.show', $hotel->id) }}">{{ $hotel->hotel_name }}</a> /
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

                    <h4 class="mb-4">Hotel Booking Form</h4>

                    <form action="{{ route('v1.booking.hotel') }}" method="POST">
                        @csrf
                        <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Select Room Type</label>
                            <select name="hotel_room_id" class="form-select" required>
                                <option value="" disabled selected>-- Select Room --</option>
                                @forelse ($hotel->rooms as $room)
                                    <option value="{{ $room->id }}" data-price="{{ $room->price_per_night }}" {{ old('hotel_room_id') == $room->id ? 'selected' : '' }}>
                                        {{ $room->room_type }} — capacity {{ $room->capacity }} people — Rp {{ number_format($room->price_per_night,0, ',', '.') }}/night
                                    </option>
                                @empty
                                    <option value="" disabled>No room types available</option>
                                @endforelse
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Check-in</label>
                                <input type="date" name="check_in" class="form-control" min="{{ now()->addDay()->format('Y-m-d') }}" value="{{ old('check_in') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Check-out</label>
                                <input type="date" name="check_out" class="form-control" min="{{ now()->addDays(2)->format('Y-m-d') }}" value="{{ old('check_out') }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Number of Rooms</label>
                            <input type="number" name="rooms" class="form-control" min="1" value="{{ old('rooms', 1) }}" required>
                        </div>

                        <hr class="my-4">
                        <h5 class="mb-3">Contact Data</h5>

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
                    <img src="{{ $hotel->foto ? asset('storage/img-hotel/'.$hotel->foto) : asset('frontend/img/travel/destination-10.webp') }}"
                         class="img-fluid rounded-4 shadow mb-3 w-100" style="max-height:220px;object-fit:cover;" alt="{{ $hotel->hotel_name }}">
                    <h5 class="mb-1">{{ $hotel->hotel_name }}</h5>
                    <p class="text-muted mb-2"><i class="bi bi-geo-alt me-1"></i>{{ $hotel->destination->destination_name ?? '-' }}</p>
                    <ul class="list-unstyled">
                        <li class="d-flex justify-content-between py-2 border-bottom"><span class="text-muted">Price / night</span><strong>Rp {{ number_format($hotel->price_per_night,0, ',', '.') }}</strong></li>
                        <li class="d-flex justify-content-between py-2"><span class="text-muted">Rating</span><strong>{{ $hotel->star_rating }} / 5</strong></li>
                    </ul>
                    <p class="small text-muted mt-3 mb-0"><i class="bi bi-info-circle me-1"></i>Total price (including 11% tax) will be calculated automatically after you fill out this form, and will be displayed on the payment page.</p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

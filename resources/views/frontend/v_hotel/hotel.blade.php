@extends('frontend.v_layouts.app')

@section('title', 'Hotels')

@section('content')

<section class="page-hero">
    <div class="container">
        <h1>Hotels</h1>
        <p class="breadcrumb-trail mb-0">
            <a href="{{ route('v1.frontend.dashboard') }}">Home</a> / <span>Hotels</span>
        </p>
    </div>
</section>

<section class="section">
    <div class="container">

        <div class="filter-bar">
            <form action="{{ route('v1.frontend.hotel') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label small fw-semibold">Search</label>
                    <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Hotel name...">
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-semibold">Destination</label>
                    <select name="destination_id" class="form-select">
                        <option value="">All Destinations</option>
                        @foreach($destinations as $d)
                            <option value="{{ $d->id }}" {{ request('destination_id') == $d->id ? 'selected' : '' }}>{{ $d->destination_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-semibold">Star Rating</label>
                    <select name="star_rating" class="form-select">
                        <option value="">Any Rating</option>
                        @for($i=5;$i>=1;$i--)
                            <option value="{{ $i }}" {{ request('star_rating') == $i ? 'selected' : '' }}>{{ $i }} Star</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-2 d-grid">
                    <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i> Filter</button>
                </div>
            </form>
        </div>

        <p class="text-muted mb-4">{{ $hotels->total() }} hotels found</p>

        <div class="row g-4">
            @forelse($hotels as $hotel)
                <div class="col-lg-4 col-md-6">
                    <div class="tt-card">
                        <div class="tt-card-img">
                            <img src="{{ $hotel->foto ? asset('storage/img-hotel/'.$hotel->foto) : asset('storage/img-hotel/'.$hotel->foto) }}">
                            <span class="tt-card-price">Rp {{ number_format($hotel->price_per_night, 0, ',', '.') }}/night</span>
                        </div>
                        <div class="tt-card-body">
                            <div class="tt-card-meta"><i class="bi bi-geo-alt"></i> {{ $hotel->destination->destination_name ?? '-' }}</div>
                            <h5>{{ $hotel->hotel_name }}</h5>
                            <p class="desc">{{ Str::limit($hotel->description, 80) }}</p>
                            <div class="tt-card-foot">
                                <span class="stars">
                                    @for($i=0;$i<$hotel->star_rating;$i++)<i class="bi bi-star-fill"></i>@endfor
                                </span>
                                <a href="{{ route('v1.frontend.hotel.show', $hotel->id) }}" class="fw-semibold">Details <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-5">
                    <i class="bi bi-building fs-1 d-block mb-2"></i>
                    No hotels match your search.
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-5">
            {{ $hotels->links() }}
        </div>
    </div>
</section>

@endsection

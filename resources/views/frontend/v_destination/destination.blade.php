@extends('frontend.v_layouts.app')

@section('title', 'Destinations')

@section('content')

<section class="page-hero">
    <div class="container">
        <h1>Destinations</h1>
        <p class="breadcrumb-trail mb-0">
            <a href="{{ route('v1.frontend.dashboard') }}">Home</a> / <span>Destinations</span>
        </p>
    </div>
</section>

<section class="section">
    <div class="container">

        <div class="filter-bar">
            <form action="{{ route('v1.frontend.destination') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label small fw-semibold">Search</label>
                    <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Destination or city name...">
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-semibold">Country</label>
                    <select name="country" class="form-select">
                        <option value="">All Countries</option>
                        @foreach($countries as $country)
                            <option value="{{ $country }}" {{ request('country') == $country ? 'selected' : '' }}>{{ $country }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-semibold">Type</label>
                    <select name="destination_type" class="form-select">
                        <option value="">Any Type</option>
                        <option value="Domestic" {{ request('destination_type') == 'Domestic' ? 'selected' : '' }}>Domestic</option>
                        <option value="International" {{ request('destination_type') == 'International' ? 'selected' : '' }}>International</option>
                    </select>
                </div>
                <div class="col-md-2 d-grid">
                    <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i> Filter</button>
                </div>
            </form>
        </div>

        <p class="text-muted mb-4">{{ $destinations->total() }} destinations found</p>

        <div class="row g-4">
            @forelse($destinations as $item)
                <div class="col-lg-4 col-md-6">
                    <div class="tt-card">
                        <div class="tt-card-img">
                            <img src="{{ $item->foto ? asset('storage/img-destination/'.$item->foto) : asset('frontend/img/travel/destination-'.(($loop->iteration % 16) + 1).'.webp') }}" alt="{{ $item->destination_name }}">
                            <span class="tt-card-badge {{ $item->status == 'Full Booked' ? 'full' : '' }}">{{ $item->destination_type }}</span>
                        </div>
                        <div class="tt-card-body">
                            <div class="tt-card-meta"><i class="bi bi-geo-alt"></i> {{ $item->city }}, {{ $item->country }}</div>
                            <h5>{{ $item->destination_name }}</h5>
                            <p class="desc">{{ Str::limit($item->description, 90) }}</p>
                            <div class="tt-card-foot">
                                <span class="status-pill {{ $item->status == 'Available' ? 'available' : 'full' }}">{{ $item->status }}</span>
                                <a href="{{ route('v1.frontend.destination.show', $item->id) }}" class="fw-semibold">Details <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-5">
                    <i class="bi bi-emoji-frown fs-1 d-block mb-2"></i>
                    No destinations match your search.
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-5">
            {{ $destinations->links() }}
        </div>
    </div>
</section>

@endsection

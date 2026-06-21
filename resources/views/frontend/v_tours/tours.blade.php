@extends('frontend.v_layouts.app')

@section('title', 'Travel Packages')

@section('content')

<section class="page-hero">
    <div class="container">
        <h1>Travel Packages</h1>
        <p class="breadcrumb-trail mb-0">
            <a href="{{ route('v1.frontend.dashboard') }}">Home</a> / <span>Travel Packages</span>
        </p>
    </div>
</section>

<section class="section">
    <div class="container">

        <div class="filter-bar">
            <form action="{{ route('v1.frontend.tours') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-5">
                    <label class="form-label small fw-semibold">Destination</label>
                    <select name="destination_id" class="form-select">
                        <option value="">All Destinations</option>
                        @foreach($destinations as $d)
                            <option value="{{ $d->id }}" {{ request('destination_id') == $d->id ? 'selected' : '' }}>{{ $d->destination_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5">
                    <label class="form-label small fw-semibold">Package Type</label>
                    <select name="package_type" class="form-select">
                        <option value="">Any Type</option>
                        @foreach($packageTypes as $type)
                            <option value="{{ $type }}" {{ request('package_type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 d-grid">
                    <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i> Filter</button>
                </div>
            </form>
        </div>

        <p class="text-muted mb-4">{{ $packages->total() }} travel packages found</p>

        <div class="row g-4">
            @forelse($packages as $pkg)
                <div class="col-lg-4 col-md-6">
                    <div class="tt-card">
                        <div class="tt-card-img">
                            <img src="{{ $pkg->foto ? asset('storage/img-package/'.$pkg->foto) : asset('frontend/img/travel/destination-'.(($loop->iteration % 16) + 4).'.webp') }}" alt="{{ $pkg->packages_name }}">
                            <span class="tt-card-badge {{ $pkg->status == 'Full Booked' ? 'full' : '' }}">{{ $pkg->package_type }}</span>
                            <span class="tt-card-price">Rp {{ number_format($pkg->price_packages, 0, ',', '.') }}</span>
                        </div>
                        <div class="tt-card-body">
                            <div class="tt-card-meta"><i class="bi bi-geo-alt"></i> {{ $pkg->destination->destination_name ?? '-' }}</div>
                            <h5>{{ $pkg->packages_name }}</h5>
                            <p class="desc">{{ Str::limit($pkg->description, 80) }}</p>
                            <div class="tt-card-meta mb-0">
                                <i class="bi bi-calendar3"></i> {{ $pkg->duration_days ?? '-' }} days
                                <span class="ms-2"><i class="bi bi-people"></i> {{ $pkg->max_persons ?? '-' }} pax</span>
                            </div>
                            <div class="tt-card-foot">
                                <span class="status-pill {{ $pkg->status == 'Available' ? 'available' : 'full' }}">{{ $pkg->status }}</span>
                                <a href="{{ route('v1.frontend.tours.show', $pkg->id) }}" class="fw-semibold">Details <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-5">
                    <i class="bi bi-suitcase-lg fs-1 d-block mb-2"></i>
                    No travel packages match your search.
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-5">
            {{ $packages->links() }}
        </div>
    </div>
</section>

@endsection

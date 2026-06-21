@extends('frontend.v_layouts.app')

@section('title', 'Transportation')

@section('content')

<section class="page-hero">
    <div class="container">
        <h1>Transportation</h1>
        <p class="breadcrumb-trail mb-0">
            <a href="{{ route('v1.frontend.dashboard') }}">Home</a> / <span>Transportation</span>
        </p>
    </div>
</section>

<section class="section">
    <div class="container">

        <div class="filter-bar">
            <form action="{{ route('v1.frontend.transportation') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label small fw-semibold">Departure From</label>
                    <select name="departure_destination_id" class="form-select">
                        <option value="">Any Origin</option>
                        @foreach($destinations as $d)
                            <option value="{{ $d->id }}" {{ request('departure_destination_id') == $d->id ? 'selected' : '' }}>{{ $d->destination_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-semibold">Transportation Type</label>
                    <select name="transportation_type" class="form-select">
                        <option value="">Any Type</option>
                        @foreach($types as $type)
                            <option value="{{ $type }}" {{ request('transportation_type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 d-grid">
                    <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i> Filter</button>
                </div>
            </form>
        </div>

        <p class="text-muted mb-4">{{ $transportations->total() }} options found</p>

        <div class="row g-4">
            @forelse($transportations as $t)
                <div class="col-lg-4 col-md-6">
                    <div class="tt-card">
                        <div class="tt-card-body">
                            <span class="tt-card-badge position-static d-inline-block mb-3" style="background:var(--accent-color-2)">{{ $t->transportation_type }}</span>
                            <h5>{{ $t->transportation_name }}</h5>

                            <div class="d-flex align-items-center justify-content-between my-3">
                                <div class="text-center">
                                    <div class="fw-bold">{{ $t->departureDestination->city ?? '-' }}</div>
                                    <small class="text-muted">{{ \Illuminate\Support\Carbon::parse($t->departure_time)->format('d M, H:i') }}</small>
                                </div>
                                <i class="bi bi-arrow-right fs-4 text-muted"></i>
                                <div class="text-center">
                                    <div class="fw-bold">{{ $t->arrivalDestination->city ?? '-' }}</div>
                                    <small class="text-muted">{{ \Illuminate\Support\Carbon::parse($t->arrival_time)->format('d M, H:i') }}</small>
                                </div>
                            </div>

                            <div class="tt-card-foot">
                                <span class="fw-bold text-success">Rp {{ number_format($t->price_per_person, 0, ',', '.') }}<small class="text-muted">/person</small></span>
                                <a href="{{ route('v1.frontend.transportation.show', $t->id) }}" class="fw-semibold">Details <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-5">
                    <i class="bi bi-bus-front fs-1 d-block mb-2"></i>
                    No transportation options match your search.
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-5">
            {{ $transportations->links() }}
        </div>
    </div>
</section>

@endsection

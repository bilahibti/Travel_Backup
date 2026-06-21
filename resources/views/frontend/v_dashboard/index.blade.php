@extends('frontend.v_layouts.app')

@section('title', 'Welcome')

@section('content')

{{-- ============ HERO ============ --}}
<section class="hero-redesign">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <span class="eyebrow"><i class="bi bi-stars"></i> Plan less. Travel more.</span>
                <h1>Discover the World, <span>One Journey at a Time</span></h1>
                <p class="lead">
                    Browse curated destinations, comfortable hotels, reliable transportation,
                    and all-in-one travel packages &mdash; everything you need for your next trip, in one place.
                </p>
                <div class="d-flex flex-wrap gap-3 mt-4">
                    <a href="{{ route('v1.frontend.tours') }}" class="btn btn-primary">
                        <i class="bi bi-suitcase-lg me-1"></i> Browse Travel Packages
                    </a>
                    <a href="{{ route('v1.frontend.destination') }}" class="btn btn-outline-light">
                        Explore Destinations
                    </a>
                </div>

                <div class="hero-stats">
                    <div class="stat">
                        <strong>{{ $totalDestinations ?? $destination->total() }}</strong>
                        <span>Destinations</span>
                    </div>
                    <div class="stat">
                        <strong>{{ $totalCountries ?? 0 }}</strong>
                        <span>Countries</span>
                    </div>
                    <div class="stat">
                        <strong>{{ $totalHotels ?? 0 }}</strong>
                        <span>Hotels</span>
                    </div>
                    <div class="stat">
                        <strong>{{ $totalPackages ?? 0 }}</strong>
                        <span>Travel Packages</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Quick search --}}
        <div class="search-card">
            <form action="{{ route('v1.frontend.destination') }}" method="GET">
                <div class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label">Country</label>
                        <select name="country" class="form-select w-100">
                            <option value="">All Countries</option>
                            @foreach(($countries ?? []) as $country)
                                <option value="{{ $country }}">{{ $country }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Destination Type</label>
                        <select name="destination_type" class="form-select w-100">
                            <option value="">Any Type</option>
                            <option value="Domestic">Domestic</option>
                            <option value="International">International</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-accent w-100">
                            <i class="bi bi-search me-1"></i> Search Destinations
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

{{-- ============ COUNTRIES & CITIES ============ --}}
<section id="explore" class="section">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-badge">Where To Next</span>
            <h2 class="section-title">Countries &amp; Cities You Can Visit</h2>
            <p class="section-sub mx-auto">
                A snapshot of every country and city currently available in our destination catalogue.
            </p>
        </div>

        @if(($countryGroups ?? collect())->isEmpty())
            <div class="text-center text-muted py-5">
                <i class="bi bi-map fs-1 d-block mb-2"></i>
                No destinations published yet. Please check back soon.
            </div>
        @else
            <div class="country-grid">
                @foreach($countryGroups as $country => $cities)
                    <div class="country-card">
                        <span class="count-badge">{{ $cities->sum() }} spot{{ $cities->sum() > 1 ? 's' : '' }}</span>
                        <div class="flag-icon"><i class="bi bi-geo-alt-fill"></i></div>
                        <h4>{{ $country }}</h4>
                        <div class="city-pills">
                            @foreach($cities->keys()->take(6) as $city)
                                <span class="city-pill">{{ $city }}</span>
                            @endforeach
                            @if($cities->keys()->count() > 6)
                                <span class="city-pill">+{{ $cities->keys()->count() - 6 }} more</span>
                            @endif
                        </div>
                        <a href="{{ route('v1.frontend.destination', ['country' => $country]) }}"
                           class="stretched-link"></a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

{{-- ============ FEATURED DESTINATIONS ============ --}}
<section id="featured-destinations" class="section light-background">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-between align-items-end mb-5">
            <div>
                <span class="section-badge">Hand-picked</span>
                <h2 class="section-title mb-0">Featured Destinations</h2>
            </div>
            <a href="{{ route('v1.frontend.destination') }}" class="btn btn-outline-primary rounded-pill mt-3 mt-md-0">
                View All Destinations <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>

        <div class="row g-4">
            @forelse($destination->take(6) as $item)
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
                <p class="text-center text-muted">No destinations available right now.</p>
            @endforelse
        </div>
    </div>
</section>

{{-- ============ WHY US ============ --}}
<section id="why-us" class="section">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-lg-6">
                <span class="section-badge">About Us</span>
                <h2 class="section-title">Creating Unforgettable Travel Experiences</h2>
                <p class="text-muted">
                    Ready to escape the ordinary? We're here to turn your travel dreams into real adventures.
                    From hidden gems to must-visit destinations, we make every trip exciting, easy, and totally
                    unforgettable. Pack your bags &mdash; we'll handle the rest.
                </p>
                <div class="row g-3 mt-2">
                    <div class="col-sm-6 d-flex gap-2"><i class="bi bi-check-circle-fill text-success"></i> Expert local guides</div>
                    <div class="col-sm-6 d-flex gap-2"><i class="bi bi-check-circle-fill text-success"></i> Verified hotels &amp; transport</div>
                    <div class="col-sm-6 d-flex gap-2"><i class="bi bi-check-circle-fill text-success"></i> Transparent pricing</div>
                    <div class="col-sm-6 d-flex gap-2"><i class="bi bi-check-circle-fill text-success"></i> 24/7 customer support</div>
                </div>
                <a href="{{ route('v1.frontend.about') }}" class="btn btn-primary mt-4">Learn More About Us</a>
            </div>
            <div class="col-lg-6">
                <div class="row g-3">
                    <div class="col-6"><img src="{{ asset('frontend/img/travel/destination-5.webp') }}" class="img-fluid rounded-4 shadow" alt=""></div>
                    <div class="col-6 pt-5"><img src="{{ asset('frontend/img/travel/destination-9.webp') }}" class="img-fluid rounded-4 shadow" alt=""></div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============ FEATURED PACKAGES ============ --}}
@if(($featuredPackages ?? collect())->isNotEmpty())
<section id="featured-packages" class="section light-background">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-badge">All-in-one</span>
            <h2 class="section-title">Popular Travel Packages</h2>
            <p class="section-sub mx-auto">Destination, hotel and transportation bundled together for a hassle-free trip.</p>
        </div>
        <div class="row g-4">
            @foreach($featuredPackages as $pkg)
                <div class="col-lg-4 col-md-6">
                    <div class="tt-card">
                        <div class="tt-card-img">
                            <img src="{{ $pkg->foto ? asset('storage/img-package/'.$pkg->foto) : asset('frontend/img/travel/destination-'.(($loop->iteration % 16) + 2).'.webp') }}" alt="{{ $pkg->packages_name }}">
                            <span class="tt-card-badge">{{ $pkg->package_type }}</span>
                            <span class="tt-card-price">${{ number_format($pkg->price_packages, 0) }}</span>
                        </div>
                        <div class="tt-card-body">
                            <div class="tt-card-meta"><i class="bi bi-geo-alt"></i> {{ $pkg->destination->destination_name ?? '-' }}</div>
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
</section>
@endif

{{-- ============ CTA ============ --}}
<section class="section">
    <div class="container">
        <div class="cta-banner text-center">
            <h2 class="mb-3">Ready for your next adventure?</h2>
            <p class="mb-4 opacity-75">Create an account to book hotels, transportation and travel packages in minutes.</p>
            <a href="{{ route('v1.frontend.login.register') }}" class="btn btn-accent">Get Started Free</a>
        </div>
    </div>
</section>

@endsection

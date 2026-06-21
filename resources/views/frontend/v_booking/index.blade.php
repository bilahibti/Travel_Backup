@extends('frontend.v_layouts.app')

@section('title', 'My Bookings - TravelTime')

@section('content')
<style>
    .page-title-booking {
      background: linear-gradient(135deg, #7c3aed, #6d28d9, #9333ea);
      padding: 100px 0 50px;
      text-align: center;
      color: #fff;
    }
    .page-title-booking h1 { font-size: 2.2rem; font-weight: 700; }
    .page-title-booking p  { opacity: .8; margin-bottom: 0; }

    .booking-card {
      border: none;
      border-radius: 18px;
      box-shadow: 0 4px 24px rgba(0,0,0,.07);
      transition: transform .2s, box-shadow .2s;
      overflow: hidden;
      margin-bottom: 1.5rem;
    }
    .booking-card:hover { transform: translateY(-3px); box-shadow: 0 8px 32px rgba(0,0,0,.12); }

    .booking-card .card-header {
      background: #fff;
      border-bottom: 2px solid #f0f4f8;
      padding: 1.2rem 1.5rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: .5rem;
    }
    .booking-code  { font-weight: 700; font-size: .95rem; color: #1a3c5e; letter-spacing: .5px; }
    .booking-date  { font-size: .82rem; color: #8a9bb0; }

    .booking-card .card-body { padding: 1.5rem; }

    .type-badge {
      display: inline-flex; align-items: center; gap: .4rem;
      padding: .35rem .9rem; border-radius: 50px; font-size: .78rem; font-weight: 600;
    }.type-package {
      background: #f3e8ff;
      color: #7c3aed;
  }

  .type-hotel {
      background: #ede9fe;
      color: #6d28d9;
  }

  .type-transport {
      background: #e9d5ff;
      color: #9333ea;
  }

  .meta-row {
      display: flex;
      gap: 1.5rem;
      flex-wrap: wrap;
      margin-bottom: 1rem;
  }

  .meta-item {
      display: flex;
      align-items: center;
      gap: .4rem;
      font-size: .88rem;
      color: #555;
  }

  .meta-item i {
      color: #7c3aed; /* ikon ungu */
  }

  .price-badge {
      font-size: 1.1rem;
      font-weight: 700;
      color: #7c3aed; /* harga ungu */
  }

  .empty-state {
      text-align: center;
      padding: 80px 20px;
  }

  .empty-state i {
      font-size: 4rem;
      color: #a855f7;
      display: block;
      margin-bottom: 1rem;
  }

  .empty-state h4 {
      color: #7c3aed;
      margin-bottom: .5rem;
  }

  .empty-state p {
      color: #9ca3af;
      max-width: 300px;
      margin: 0 auto 1.5rem;
  }
</style>

<!-- Page Title -->
<div class="page-title-booking">
  <div class="container">
    <h1><i class="bi bi-journal-bookmark-fill me-2"></i>My Bookings</h1>
    <p>Manage all your travel bookings</p>
  </div>
</div>

<section style="padding: 50px 0 80px; background: #f4f8fb;">
  <div class="container">

    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show mb-4">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif
    @if(session('error'))
      <div class="alert alert-danger alert-dismissible fade show mb-4">
        <i class="bi bi-exclamation-circle-fill me-2"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif

    @if($bookings->isEmpty())
      <div class="empty-state">
        <i class="bi bi-suitcase-lg"></i>
        <h4>No Bookings Found</h4>
        <p>Start planning your next trip!</p>
        <a href="{{ route('v1.frontend.tours') }}" class="btn btn-primary px-4">
          <i class="bi bi-compass me-1"></i> Start Exploring
        </a>
      </div>
    @else
      <div class="row">
        <div class="col-12">
          @foreach($bookings as $booking)
            <div class="booking-card card">
              <div class="card-header">
                <div>
                  <span class="booking-code">{{ $booking->booking_code }}</span>
                  @php
                    $typeClass = match($booking->type) {
                      'package'   => 'type-package',
                      'hotel'     => 'type-hotel',
                      'transport' => 'type-transport',
                      default     => 'type-package',
                    };
                    $typeIcon = match($booking->type) {
                      'package'   => 'bi-map',
                      'hotel'     => 'bi-building',
                      'transport' => 'bi-truck',
                      default     => 'bi-map',
                    };
                  @endphp
                  <span class="type-badge {{ $typeClass }} ms-2">
                    <i class="{{ $typeIcon }}"></i> {{ $booking->typeLabel() }}
                  </span>
                </div>
                <div class="d-flex align-items-center gap-2">
                  <span class="badge bg-{{ $booking->statusBadgeClass() }} rounded-pill px-3 py-2">
                    {{ $booking->statusLabel() }}
                  </span>
                  <span class="booking-date">{{ $booking->created_at->format('d M Y') }}</span>
                </div>
              </div>

              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-md-8">
                    {{-- Package / Hotel / Transport Name --}}
                    <h5 class="fw-700 mb-2" style="color:#1a3c5e;">
                      @if($booking->type === 'package' && $booking->packages->first())
                        <i class="{{ $typeIcon }} me-2" style="color:#e8a838;"></i>
                        {{ $booking->packages->first()->travelPackage->packages_name ?? '-' }}
                      @elseif($booking->type === 'hotel' && $booking->hotels->first())
                        <i class="{{ $typeIcon }} me-2" style="color:#e8a838;"></i>
                        {{ $booking->hotels->first()->hotel->hotel_name ?? '-' }}
                      @elseif($booking->type === 'transport' && $booking->transports->first())
                        <i class="{{ $typeIcon }} me-2" style="color:#e8a838;"></i>
                        {{ $booking->transports->first()->transportation->transportation_name ?? '-' }}
                      @endif
                    </h5>

                    <div class="meta-row">
                      <div class="meta-item">
                        <i class="bi bi-calendar-event"></i>
                        {{ $booking->travel_date?->format('d M Y') }}
                        @if($booking->return_date)
                          → {{ $booking->return_date?->format('d M Y') }}
                        @endif
                      </div>
                      @if($booking->total_persons)
                        <div class="meta-item">
                          <i class="bi bi-people"></i>
                          {{ $booking->total_persons }}
                          {{ $booking->type === 'hotel' ? 'kamar' : 'orang' }}
                        </div>
                      @endif
                      <div class="meta-item">
                        <i class="bi bi-person"></i> {{ $booking->contact_name }}
                      </div>
                    </div>
                  </div>

                  <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <div class="price-badge mb-3">
                      Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                    </div>
                    <div class="d-flex gap-2 justify-content-md-end flex-wrap">
                      <a href="{{ route('v1.booking.show', $booking->id) }}"
                         class="btn btn-outline-primary btn-sm px-3">
                        <i class="bi bi-eye me-1"></i> Detail
                      </a>
                      @if($booking->status === 'pending' && !$booking->isPaid())
                        <a href="{{ route('v1.payment.show', $booking->id) }}"
                           class="btn btn-warning btn-sm px-3 fw-600">
                          <i class="bi bi-credit-card me-1"></i> Pay Now
                        </a>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @endforeach

          {{-- Pagination --}}
          <div class="d-flex justify-content-center mt-2">
            {{ $bookings->links() }}
          </div>
        </div>
      </div>
    @endif
  </div>
</section>
@endsection
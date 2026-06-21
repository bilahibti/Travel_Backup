@extends('frontend.v_layouts.app')

@section('title', 'Detail Booking - ' . $booking->booking_code)

@section('content')
<style>
  .page-title-booking {
    background: linear-gradient(135deg, #7c3aed, #6d28d9, #9333ea);
    padding: 100px 0 50px;
    text-align: center;
    color: #fff;
  }
  .page-title-booking h1 { font-size: 2rem; font-weight: 700; }

  .detail-card {
    border: none; border-radius: 18px;
    box-shadow: 0 4px 24px rgba(0,0,0,.07);
    overflow: hidden; margin-bottom: 1.5rem;
  }
  .detail-card .section-title {
    font-size: .85rem; font-weight: 700; text-transform: uppercase;
    letter-spacing: 1px; color: #7a8fa6; margin-bottom: 1rem;
  }
  .info-row {
    display: flex; justify-content: space-between; align-items: center;
    padding: .6rem 0; border-bottom: 1px solid #f0f4f8;
  }
  .info-row:last-child { border-bottom: none; }
  .info-label { font-size: .88rem; color: #8a9bb0; }
  .info-value { font-size: .9rem; font-weight: 600; color: #1a3c5e; text-align: right; }

  .status-pill {
    display: inline-block; padding: .4rem 1.2rem;
    border-radius: 50px; font-weight: 700; font-size: .85rem;
  }

  .total-box {
    background: linear-gradient(135deg, #7c3aed, #6d28d9);
    border-radius: 14px; padding: 1.5rem; color: #fff; margin-bottom: 1.5rem;
  }
  .total-box .label { font-size: .85rem; opacity: .8; }
  .total-box .amount { font-size: 2rem; font-weight: 800; }

  .payment-badge {
    display: inline-flex; align-items: center; gap: .5rem;
    padding: .5rem 1.2rem; border-radius: 10px;
    font-size: .88rem; font-weight: 600;
    background: #d4edda; color: #155724;
  }
  .timeline { padding-left: .5rem; }
  .timeline-item {
    display: flex; gap: 1rem; margin-bottom: 1.2rem;
  }
  .timeline-dot {
    width: 36px; height: 36px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; font-size: .9rem;
  }
</style>

<!-- Page Title -->
<div class="page-title-booking">
  <div class="container">
    <h1>Detail Booking</h1>
    <p class="mb-0" style="opacity:.8;">{{ $booking->booking_code }}</p>
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

    <div class="mb-4">
      <a href="{{ route('v1.booking.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke My Bookings
      </a>
    </div>

    <div class="row">
      <!-- LEFT COLUMN -->
      <div class="col-lg-8">

        <!-- Status Booking -->
        <div class="detail-card card p-4 mb-4">
          <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
            <div>
              <div class="section-title mb-1">Booking Status</div>
              <span class="status-pill bg-{{ $booking->statusBadgeClass() }} text-white">
                {{ $booking->statusLabel() }}
              </span>
            </div>
            <div class="text-end">
              <div class="text-muted" style="font-size:.82rem;">Created</div>
              <div style="font-size:.9rem; font-weight:600;">{{ $booking->created_at->format('d M Y, H:i') }}</div>
            </div>
          </div>
        </div>

        <!-- Detail Paket / Hotel / Transport -->
        <div class="detail-card card p-4 mb-4">
          <div class="section-title">Booking Details</div>

          @if($booking->type === 'package' && $booking->packages->isNotEmpty())
            @foreach($booking->packages as $pkg)
              <div class="d-flex gap-3 align-items-start mb-3">
                <div>
                  <h5 style="font-weight:700; color:#1a3c5e; margin-bottom:.3rem;">
                    {{ $pkg->travelPackage->packages_name ?? '-' }}
                  </h5>
                  <span class="badge" style="background:#fff3cd; color:#856404;">
                    {{ $pkg->travelPackage->package_type ?? 'Paket' }}
                  </span>
                  @if($pkg->travelPackage?->destination)
                    <span class="ms-2" style="font-size:.85rem; color:#7a8fa6;">
                      <i class="bi bi-geo-alt me-1"></i>{{ $pkg->travelPackage->destination->destination_name }}
                    </span>
                  @endif
                </div>
              </div>
              <div class="info-row"><span class="info-label">Number of People</span><span class="info-value">{{ $pkg->persons }} people</span></div>
              <div class="info-row"><span class="info-label">Price per Person</span><span class="info-value">Rp {{ number_format($pkg->unit_price, 0, ',', '.') }}</span></div>
              <div class="info-row"><span class="info-label">Duration</span><span class="info-value">{{ $pkg->travelPackage->duration_days ?? '-' }} days</span></div>
            @endforeach

          @elseif($booking->type === 'hotel' && $booking->hotels->isNotEmpty())
            @foreach($booking->hotels as $hotelBooking)
              <div class="d-flex gap-3 align-items-start mb-3">
                <div>
                  <h5 style="font-weight:700; color:#1a3c5e; margin-bottom:.3rem;">
                    {{ $hotelBooking->hotel->hotel_name ?? '-' }}
                  </h5>
                  @if($hotelBooking->room)
                    <span class="badge" style="background:#d1ecf1; color:#0c5460;">
                      {{ $hotelBooking->room->room_type }}
                    </span>
                  @endif
                </div>
              </div>
              <div class="info-row"><span class="info-label">Check In</span><span class="info-value">{{ $hotelBooking->check_in?->format('d M Y') }}</span></div>
              <div class="info-row"><span class="info-label">Check Out</span><span class="info-value">{{ $hotelBooking->check_out?->format('d M Y') }}</span></div>
              <div class="info-row"><span class="info-label">Number of Rooms</span><span class="info-value">{{ $hotelBooking->rooms }} rooms</span></div>
              <div class="info-row"><span class="info-label">Number of Nights</span><span class="info-value">{{ $hotelBooking->nights }} nights</span></div>
              <div class="info-row"><span class="info-label">Price per Night</span><span class="info-value">Rp {{ number_format($hotelBooking->price_per_night, 0, ',', '.') }}</span></div>
            @endforeach

          @elseif($booking->type === 'transport' && $booking->transports->isNotEmpty())
            @foreach($booking->transports as $trBooking)
              <div class="mb-3">
                <h5 style="font-weight:700; color:#1a3c5e; margin-bottom:.3rem;">
                  {{ $trBooking->transportation->transportation_name ?? '-' }}
                </h5>
                @if($trBooking->transportation)
                  <span class="badge" style="background:#d4edda; color:#155724;">
                    {{ $trBooking->transportation->type }}
                  </span>
                @endif
              </div>
              <div class="info-row"><span class="info-label">Number of Days</span><span class="info-value">{{ $trBooking->days }} days</span></div>
              <div class="info-row"><span class="info-label">Pickup</span><span class="info-value">{{ $trBooking->pickup_location }}</span></div>
              @if($trBooking->dropoff_location)
                <div class="info-row"><span class="info-label">Drop-off</span><span class="info-value">{{ $trBooking->dropoff_location }}</span></div>
              @endif
            @endforeach
          @endif

          @if($booking->notes)
            <div class="mt-3 p-3" style="background:#f8f9fa; border-radius:10px; font-size:.88rem;">
              <i class="bi bi-chat-text me-1 text-muted"></i>
              <strong>Catatan:</strong> {{ $booking->notes }}
            </div>
          @endif
        </div>

        <!-- Kontak -->
        <div class="detail-card card p-4">
          <div class="section-title">Contact Information</div>
          <div class="info-row"><span class="info-label">Name</span><span class="info-value">{{ $booking->contact_name }}</span></div>
          <div class="info-row"><span class="info-label">Phone</span><span class="info-value">{{ $booking->contact_phone }}</span></div>
          <div class="info-row"><span class="info-label">Email</span><span class="info-value">{{ $booking->contact_email }}</span></div>
          <div class="info-row"><span class="info-label">Travel Date</span><span class="info-value">{{ $booking->travel_date?->format('d M Y') }}</span></div>
          @if($booking->return_date)
            <div class="info-row"><span class="info-label">Return Date</span><span class="info-value">{{ $booking->return_date?->format('d M Y') }}</span></div>
          @endif
        </div>
      </div>

      <!-- RIGHT COLUMN -->
      <div class="col-lg-4 mt-4 mt-lg-0">

        <!-- Total Harga -->
        <div class="total-box">
          <div class="label mb-1">Total Payment</div>
          <div class="amount">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</div>
          <div class="mt-2" style="font-size:.82rem; opacity:.7;">
            Subtotal: Rp {{ number_format($booking->subtotal, 0, ',', '.') }}<br>
            Tax (11%): Rp {{ number_format($booking->tax, 0, ',', '.') }}
          </div>
        </div>

        <!-- Riwayat Payment -->
        <div class="detail-card card p-4 mb-4">
          <div class="section-title">Payment Status</div>
          @forelse($booking->payments as $payment)
            <div class="payment-badge mb-2 w-100 justify-content-between">
              <span><i class="{{ $payment->methodIcon() }} me-1"></i> {{ $payment->methodLabel() }}</span>
              <span>{{ $payment->paid_at?->format('d M Y') }}</span>
            </div>
            <div class="text-center text-success mt-1">
              <i class="bi bi-check-circle-fill me-1"></i> Paid
            </div>
          @empty
            <div class="text-center text-muted py-2">
              <i class="bi bi-hourglass-split d-block fs-3 mb-1"></i>
              Not Paid
            </div>
            @if(in_array($booking->status, ['pending']))
              <a href="{{ route('v1.payment.show', $booking->id) }}"
                 class="btn btn-warning w-100 mt-3 fw-600">
                <i class="bi bi-credit-card me-1"></i> Pay Now
              </a>
            @endif
          @endforelse
        </div>

        <!-- Aksi -->
        <div class="detail-card card p-4">
          <div class="section-title">Actions</div>
          @if(in_array($booking->status, ['pending', 'confirmed']))
            <form method="POST" action="{{ route('v1.booking.cancel', $booking->id) }}"
                  onsubmit="return confirm('Batalkan booking ini?')">
              @csrf @method('PUT')
              <button type="submit" class="btn btn-outline-danger w-100">
                <i class="bi bi-x-circle me-1"></i> Cancel Booking
              </button>
            </form>
          @else
            <p class="text-center text-muted small mb-0">
              No actions available for this booking status.
            </p>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
@extends('frontend.v_layouts.app')

@section('title', 'Pembayaran - ' . $booking->booking_code)

@section('content')
<style>
  .page-title-payment {
    background: linear-gradient(135deg, #1a3c5e, #2c5364);
    padding: 100px 0 50px; text-align: center; color: #fff;
  }
  .page-title-payment h1 { font-size: 2rem; font-weight: 700; }

  .payment-layout { display: grid; grid-template-columns: 1fr 380px; gap: 2rem; }
  @media (max-width: 991px) { .payment-layout { grid-template-columns: 1fr; } }

  .pay-card {
    border: none; border-radius: 18px;
    box-shadow: 0 4px 24px rgba(0,0,0,.07);
    padding: 2rem; margin-bottom: 1.5rem;
  }
  .pay-card h4 {
    font-size: 1rem; font-weight: 700; text-transform: uppercase;
    letter-spacing: 1px; color: #7a8fa6; border-bottom: 2px solid #f0f4f8;
    padding-bottom: .75rem; margin-bottom: 1.5rem;
  }

  /* Method cards */
  .method-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); gap: 1rem; }
  .method-card {
    border: 2px solid #e9ecef; border-radius: 14px; padding: 1.2rem 1rem;
    cursor: pointer; transition: all .2s; text-align: center; background: #fff;
    position: relative; overflow: hidden;
  }
  .method-card:hover { border-color: #e8a838; transform: translateY(-2px); }
  .method-card.selected { border-color: #2c5364; background: #f0f6fc; }
  .method-card.selected::after {
    content: '\F26B'; font-family: 'bootstrap-icons'; position: absolute;
    top: 8px; right: 10px; color: #2c5364; font-size: .9rem; font-weight: 700;
  }
  .method-icon { font-size: 1.8rem; margin-bottom: .5rem; color: #2c5364; }
  .method-label { font-size: .85rem; font-weight: 700; color: #1a3c5e; }
  .method-desc  { font-size: .75rem; color: #8a9bb0; margin-top: .2rem; }

  input[type="radio"].method-radio { display: none; }

  /* Summary */
  .summary-card { background: #fff; border-radius: 18px; box-shadow: 0 4px 24px rgba(0,0,0,.07); overflow: hidden; }
  .summary-header {
    background: linear-gradient(135deg, #1a3c5e, #2c5364);
    padding: 1.5rem; color: #fff;
  }
  .summary-header .booking-code { font-size: .82rem; opacity: .7; }
  .summary-header h3 { font-size: 1.1rem; font-weight: 700; margin: .3rem 0 0; }

  .summary-body { padding: 1.5rem; }
  .summary-row {
    display: flex; justify-content: space-between; align-items: center;
    padding: .6rem 0; border-bottom: 1px solid #f0f4f8; font-size: .9rem;
  }
  .summary-row:last-child { border-bottom: none; }
  .summary-row .label { color: #7a8fa6; }
  .summary-row .value { font-weight: 600; color: #1a3c5e; }

  .total-section {
    background: #f4f8fb; border-radius: 12px;
    padding: 1.2rem; margin-top: 1rem; text-align: center;
  }
  .total-section .lbl { font-size: .8rem; text-transform: uppercase; letter-spacing: 1px; color: #7a8fa6; }
  .total-section .amt { font-size: 1.8rem; font-weight: 800; color: #1a3c5e; }

  .btn-pay {
    width: 100%; padding: 1rem; border-radius: 12px; font-size: 1.05rem;
    font-weight: 700; background: linear-gradient(135deg, #e8a838, #f5c842);
    border: none; color: #1a3c5e; margin-top: 1.2rem;
    transition: opacity .2s, transform .1s;
  }
  .btn-pay:hover  { opacity: .9; transform: translateY(-1px); }
  .btn-pay:active { transform: translateY(0); }
  .btn-pay:disabled { opacity: .5; cursor: not-allowed; }

  .security-note {
    display: flex; align-items: center; gap: .5rem;
    font-size: .78rem; color: #8a9bb0; margin-top: .8rem; justify-content: center;
  }
</style>

<!-- Page Title -->
<div class="page-title-payment">
  <div class="container">
    <h1><i class="bi bi-credit-card-fill me-2"></i>Pembayaran</h1>
    <p class="mb-0" style="opacity:.8;">Selesaikan pembayaran untuk mengkonfirmasi booking Anda</p>
  </div>
</div>

<section style="padding: 50px 0 80px; background: #f4f8fb;">
  <div class="container">

    @if($errors->any())
      <div class="alert alert-danger alert-dismissible fade show mb-4">
        <i class="bi bi-exclamation-circle me-2"></i>
        @foreach($errors->all() as $err) {{ $err }}<br> @endforeach
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif

    <div class="mb-4">
      <a href="{{ route('v1.booking.show', $booking->id) }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke Detail Booking
      </a>
    </div>

    <div class="payment-layout">

      <!-- KIRI: Form Payment -->
      <div>
        <form method="POST" action="{{ route('v1.payment.store') }}" id="paymentForm">
          @csrf
          <input type="hidden" name="booking_id" value="{{ $booking->id }}">

          <!-- Pilih Metode Pembayaran -->
          <div class="pay-card">
            <h4><i class="bi bi-wallet2 me-2"></i>Pilih Metode Pembayaran</h4>
            <div class="method-grid">
              @foreach($paymentMethods as $key => $method)
                <label for="method_{{ $key }}" class="method-card" id="card_{{ $key }}">
                  <input type="radio" name="method" id="method_{{ $key }}"
                         value="{{ $key }}" class="method-radio"
                         {{ old('method') === $key ? 'checked' : '' }}>
                  <div class="method-icon"><i class="{{ $method['icon'] }}"></i></div>
                  <div class="method-label">{{ $method['label'] }}</div>
                  <div class="method-desc">{{ $method['desc'] }}</div>
                </label>
              @endforeach
            </div>
            @error('method')
              <div class="text-danger small mt-2"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
            @enderror
          </div>

          <!-- Instruksi (dynamic) -->
          <div class="pay-card" id="instructionBox" style="display:none;">
            <h4><i class="bi bi-info-circle me-2"></i>Instruksi Pembayaran</h4>
            <div id="instructionContent"></div>
          </div>

          <!-- Catatan opsional -->
          <div class="pay-card">
            <h4><i class="bi bi-chat-text me-2"></i>Catatan (Opsional)</h4>
            <textarea name="notes" class="form-control" rows="3"
                      placeholder="Tambahkan catatan pembayaran jika diperlukan...">{{ old('notes') }}</textarea>
          </div>
        </form>
      </div>

      <!-- KANAN: Summary -->
      <div>
        <div class="summary-card">
          <div class="summary-header">
            <div class="booking-code">{{ $booking->booking_code }}</div>
            <h3>
              @if($booking->type === 'package' && $booking->packages->first())
                {{ $booking->packages->first()->travelPackage->packages_name ?? 'Paket Wisata' }}
              @elseif($booking->type === 'hotel' && $booking->hotels->first())
                {{ $booking->hotels->first()->hotel->hotel_name ?? 'Hotel' }}
              @elseif($booking->type === 'transport' && $booking->transports->first())
                {{ $booking->transports->first()->transportation->transportation_name ?? 'Transportasi' }}
              @endif
            </h3>
          </div>

          <div class="summary-body">
            <div class="summary-row">
              <span class="label">Tipe</span>
              <span class="value">{{ $booking->typeLabel() }}</span>
            </div>
            <div class="summary-row">
              <span class="label">Tanggal</span>
              <span class="value">{{ $booking->travel_date?->format('d M Y') }}</span>
            </div>
            @if($booking->return_date)
              <div class="summary-row">
                <span class="label">Kembali</span>
                <span class="value">{{ $booking->return_date?->format('d M Y') }}</span>
              </div>
            @endif
            <div class="summary-row">
              <span class="label">Kontak</span>
              <span class="value">{{ $booking->contact_name }}</span>
            </div>
            <div class="summary-row">
              <span class="label">Subtotal</span>
              <span class="value">Rp {{ number_format($booking->subtotal, 0, ',', '.') }}</span>
            </div>
            <div class="summary-row">
              <span class="label">Pajak (11%)</span>
              <span class="value">Rp {{ number_format($booking->tax, 0, ',', '.') }}</span>
            </div>

            <div class="total-section">
              <div class="lbl">Total Pembayaran</div>
              <div class="amt">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</div>
            </div>

            <button type="submit" form="paymentForm" class="btn-pay" id="btnPay" disabled>
              <i class="bi bi-lock-fill me-2"></i>Bayar Sekarang
            </button>

            <div class="security-note">
              <i class="bi bi-shield-check"></i> Pembayaran diproses dengan aman
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  const instructions = {
    bank_transfer: `
      <ol class="ps-3" style="font-size:.88rem; color:#555; line-height:1.9;">
        <li>Catat kode booking Anda: <strong>{{ $booking->booking_code }}</strong></li>
        <li>Transfer ke salah satu rekening berikut:<br>
          &bull; <strong>BCA</strong> 1234567890 a.n. PT TravelTime Indonesia<br>
          &bull; <strong>Mandiri</strong> 9876543210 a.n. PT TravelTime Indonesia</li>
        <li>Nominal tepat: <strong>Rp {{ number_format($booking->total_price, 0, ',', '.') }}</strong></li>
        <li>Konfirmasi transfer via WhatsApp / email dalam 1×24 jam.</li>
      </ol>`,
    virtual_account: `
      <div style="font-size:.88rem; color:#555; line-height:1.9;">
        <p>Nomor Virtual Account akan dikirim ke <strong>{{ $booking->contact_email }}</strong> setelah Anda mengklik "Bayar Sekarang".</p>
        <p>Bayar sebelum: <strong>{{ now()->addHours(24)->format('d M Y, H:i') }}</strong></p>
      </div>`,
    e_wallet: `
      <div style="font-size:.88rem; color:#555; line-height:1.9;">
        <p>Setelah klik "Bayar Sekarang", Anda akan diarahkan ke halaman e-wallet pilihan Anda.</p>
        <p>Pastikan saldo mencukupi: <strong>Rp {{ number_format($booking->total_price, 0, ',', '.') }}</strong></p>
      </div>`,
    qris: `
      <div style="font-size:.88rem; color:#555; text-align:center;">
        <div style="background:#f0f4f8; border-radius:12px; padding:1rem; display:inline-block; margin-bottom:.5rem;">
          <i class="bi bi-qr-code" style="font-size:4rem; color:#1a3c5e;"></i>
        </div>
        <p class="mb-0">QR Code akan ditampilkan setelah Anda mengklik "Bayar Sekarang".<br>
        Scan dengan aplikasi apapun yang mendukung QRIS.</p>
      </div>`,
    credit_card: `
      <div style="font-size:.88rem; color:#555; line-height:1.9;">
        <p>Isi data kartu kredit Anda di halaman berikutnya. Transaksi diproses secara aman via Midtrans / Stripe.</p>
        <p>Kartu yang diterima: <strong>Visa, Mastercard, JCB, American Express</strong></p>
      </div>`,
    debit_card: `
      <div style="font-size:.88rem; color:#555; line-height:1.9;">
        <p>Isi data kartu debit Anda di halaman berikutnya. Pastikan kartu Anda sudah diaktifkan untuk transaksi online.</p>
      </div>`,
  };

  document.querySelectorAll('.method-radio').forEach(radio => {
    radio.addEventListener('change', function () {
      // Highlight selected card
      document.querySelectorAll('.method-card').forEach(c => c.classList.remove('selected'));
      document.getElementById('card_' + this.value).classList.add('selected');

      // Show instructions
      const box = document.getElementById('instructionBox');
      const content = document.getElementById('instructionContent');
      box.style.display = 'block';
      content.innerHTML = instructions[this.value] || '';

      // Enable pay button
      document.getElementById('btnPay').disabled = false;
    });
  });

  // Restore on old() if any
  const oldMethod = '{{ old("method") }}';
  if (oldMethod) {
    const el = document.getElementById('method_' + oldMethod);
    if (el) { el.checked = true; el.dispatchEvent(new Event('change')); }
  }
</script>
@endsection
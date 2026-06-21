<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PaymentController extends Controller
{
    /**
     * Halaman form payment.
     * GET /v1/payment/{bookingId}
     */
    public function show(string $bookingId)
    {
        $booking = Booking::with([
                'packages.travelPackage',
                'hotels.hotel',
                'hotels.room',
                'transports.transportation',
                'payments',
            ])
            ->where('id', $bookingId)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        // Jika sudah dibayar, redirect ke detail booking
        if ($booking->isPaid()) {
            return redirect()
                ->route('v1.booking.show', $booking->id)
                ->with('info', 'Booking this has already been paid.');
        }

        // Jika dibatalkan, tidak bisa bayar
        if (in_array($booking->status, ['cancelled', 'refunded'])) {
            return redirect()
                ->route('v1.booking.show', $booking->id)
                ->with('error', 'Canceled bookings cannot be paid.');
        }

        $paymentMethods = [
            'bank_transfer'  => ['label' => 'Bank Transfer',   'icon' => 'bi-bank',              'desc' => 'BCA, Mandiri, BNI, BRI'],
            'virtual_account'=> ['label' => 'Virtual Account', 'icon' => 'bi-credit-card-2-front','desc' => 'Bayar via kode VA Bank'],
            'e_wallet'       => ['label' => 'E-Wallet',        'icon' => 'bi-phone',             'desc' => 'GoPay, OVO, Dana, ShopeePay'],
            'qris'           => ['label' => 'QRIS',            'icon' => 'bi-qr-code-scan',      'desc' => 'Scan QR dengan app apapun'],
            'credit_card'    => ['label' => 'Kartu Kredit',    'icon' => 'bi-credit-card',       'desc' => 'Visa, Mastercard, JCB'],
            'debit_card'     => ['label' => 'Kartu Debit',     'icon' => 'bi-credit-card-2-back', 'desc' => 'Debit semua bank'],
        ];

        return view('frontend.v_payment.show', compact('booking', 'paymentMethods'));
    }

    /**
     * Proses pembayaran.
     * POST /v1/payment
     */
    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:booking,id',
            'method'     => 'required|in:bank_transfer,credit_card,debit_card,e_wallet,virtual_account,qris',
            'notes'      => 'nullable|string|max:255',
        ]);

        $booking = Booking::where('id', $request->booking_id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        // Guard: sudah dibayar
        if ($booking->isPaid()) {
            return redirect()
                ->route('v1.booking.show', $booking->id)
                ->with('error', 'Booking this has already been paid.');
        }

        // Guard: dibatalkan
        if (in_array($booking->status, ['cancelled', 'refunded'])) {
            return redirect()
                ->route('v1.booking.show', $booking->id)
                ->with('error', 'Canceled bookings cannot be paid.');
        }

        DB::transaction(function () use ($request, $booking) {
            Payment::create([
                'booking_id'       => $booking->id,
                'amount'           => $booking->total_price,
                'method'           => $request->method,
                'status'           => 'paid',
                'paid_at'          => now(),
                'notes'            => $request->notes,
                'payment_detail'   => [
                    'method_label' => ucwords(str_replace('_', ' ', $request->method)),
                    'paid_by'      => auth()->user()->name,
                    'ip'           => request()->ip(),
                ],
            ]);

            $booking->update(['status' => 'confirmed']);
        });

        return redirect()
            ->route('v1.booking.show', $booking->id)
            ->with('success', '🎉 Payment successful! Your booking has been confirmed.');
    }
}
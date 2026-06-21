<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\TravelPackages;
use App\Models\Hotel;
use App\Models\HotelRoom;
use App\Models\Transportation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookingController extends Controller
{
    // ─────────────────────────────────────────────
    //  FRONTEND CUSTOMER
    // ─────────────────────────────────────────────

    /**
     * Daftar semua booking milik user yang login.
     */
    public function myBookings()
    {
        $bookings = Booking::with([
                'packages.travelPackage',
                'hotels.hotel',
                'transports.transportation',
                'payments',
            ])
            ->where('user_id', auth()->id())
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('frontend.v_booking.index', compact('bookings'));
    }

    /**
     * Detail satu booking milik user yang login.
     */
    public function myBookingDetail(string $id)
    {
        $booking = Booking::with([
                'packages.travelPackage.destination',
                'hotels.hotel.destination',
                'hotels.room',
                'transports.transportation',
                'payments',
            ])
            ->where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('frontend.v_booking.show', compact('booking'));
    }

    // ─────────────────────────────────────────────
    //  FORM PEMESANAN (GET) — ditampilkan saat klik "Book Now"
    // ─────────────────────────────────────────────

    /**
     * Form booking paket wisata.
     * GET /v1/booking/package/{id}/create
     */
    public function createPackageForm(string $id)
    {
        $package = TravelPackages::with(['destination', 'hotel', 'transportation'])->findOrFail($id);
        return view('frontend.v_booking.create_package', compact('package'));
    }

    /**
     * Form booking hotel.
     * GET /v1/booking/hotel/{id}/create
     */
    public function createHotelForm(string $id)
    {
        $hotel = Hotel::with(['destination', 'rooms'])->findOrFail($id);
        return view('frontend.v_booking.create_hotel', compact('hotel'));
    }

    /**
     * Form booking transportasi.
     * GET /v1/booking/transport/{id}/create
     */
    public function createTransportForm(string $id)
    {
        $transport = Transportation::findOrFail($id);
        return view('frontend.v_booking.create_transport', compact('transport'));
    }

    // ─────────────────────────────────────────────
    //  BOOKING — PACKAGE
    // ─────────────────────────────────────────────

    /**
     * Proses booking paket wisata.
     * POST /v1/booking/package
     */
    public function bookPackage(Request $request)
    {
        $request->validate([
            'travel_package_id' => 'required|exists:travel_packages,id',
            'travel_date'       => 'required|date|after:today',
            'persons'           => 'required|integer|min:1|max:50',
            'contact_name'      => 'required|string|max:100',
            'contact_phone'     => 'required|string|max:20',
            'contact_email'     => 'required|email',
            'notes'             => 'nullable|string|max:500',
        ]);

        $package = TravelPackages::findOrFail($request->travel_package_id);

        // Validasi ketersediaan
        if (!$package->is_active) {
            return back()->withErrors(['travel_package_id' => 'Travel package is not available.'])->withInput();
        }

        if ($request->persons > $package->max_persons) {
            return back()->withErrors(['persons' => "Maximum {$package->max_persons} persons allowed for this package."])->withInput();
        }

        // Hitung harga
        $subtotal   = $package->price_packages * $request->persons;
        $tax        = $subtotal * 0.11;            // PPN 11 %
        $grandTotal = $subtotal + $tax;
        $returnDate = Carbon::parse($request->travel_date)->addDays($package->duration_days ?? 1);

        $booking = DB::transaction(function () use ($request, $package, $subtotal, $tax, $grandTotal, $returnDate) {
            $booking = Booking::create([
                'user_id'       => auth()->id(),
                'type'          => 'package',
                'status'        => 'pending',
                'subtotal'      => $subtotal,
                'tax'           => $tax,
                'total_price'   => $grandTotal,
                'travel_date'   => $request->travel_date,
                'total_persons' => $request->persons,
                'contact_name'  => $request->contact_name,
                'contact_phone' => $request->contact_phone,
                'contact_email' => $request->contact_email,
                'notes'         => $request->notes,
            ]);

            $booking->packages()->create([
                'travel_package_id'    => $package->id,
                'persons'              => $request->persons,
                'unit_price'           => $package->price_packages,
                'packages_total_price' => $subtotal,
            ]);

            return $booking;
        });

        return redirect()
            ->route('v1.payment.show', $booking->id)
            ->with('success', 'Booking created successfully! Please complete the payment.');
    }

    // ─────────────────────────────────────────────
    //  BOOKING — HOTEL
    // ─────────────────────────────────────────────

    /**
     * Proses booking hotel.
     * POST /v1/booking/hotel
     */
    public function bookHotel(Request $request)
    {
        $request->validate([
            'hotel_id'      => 'required|exists:hotel,id',
            'hotel_room_id' => 'required|exists:hotel_rooms,id',
            'check_in'      => 'required|date|after:today',
            'check_out'     => 'required|date|after:check_in',
            'rooms'         => 'required|integer|min:1',
            'contact_name'  => 'required|string|max:100',
            'contact_phone' => 'required|string|max:20',
            'contact_email' => 'required|email',
            'notes'         => 'nullable|string|max:500',
        ]);

        $hotel = Hotel::findOrFail($request->hotel_id);
        $room  = HotelRoom::findOrFail($request->hotel_room_id);

        if (!$hotel->is_active) {
            return back()->withErrors(['hotel_id' => 'Hotel is not available.'])->withInput();
        }

        // Cek ketersediaan kamar
        $bookedRooms = $room->bookings()
            ->whereHas('booking', fn($q) => $q
                ->whereNotIn('status', ['cancelled', 'refunded'])
                ->where('travel_date', '<', $request->check_out)
                ->where('return_date', '>', $request->check_in)
            )->sum('rooms');

        $available = $room->total_rooms - $bookedRooms;
        if ($request->rooms > $available) {
            return back()->withErrors(['rooms' => "Only {$available} rooms available for the selected date."])->withInput();
        }

        $nights     = Carbon::parse($request->check_in)->diffInDays($request->check_out);
        $subtotal   = $room->price_per_night * $request->rooms * $nights;
        $tax        = $subtotal * 0.11;
        $grandTotal = $subtotal + $tax;

        $booking = DB::transaction(function () use ($request, $hotel, $room, $subtotal, $tax, $grandTotal, $nights) {
            $booking = Booking::create([
                'user_id'       => auth()->id(),
                'type'          => 'hotel',
                'status'        => 'pending',
                'subtotal'      => $subtotal,
                'tax'           => $tax,
                'total_price'   => $grandTotal,
                'travel_date'   => $request->check_in,
                'return_date'   => $request->check_out,
                'total_persons' => $request->rooms,
                'contact_name'  => $request->contact_name,
                'contact_phone' => $request->contact_phone,
                'contact_email' => $request->contact_email,
                'notes'         => $request->notes,
            ]);

            $booking->hotels()->create([
                'hotel_id'        => $hotel->id,
                'hotel_room_id'   => $room->id,
                'check_in'        => $request->check_in,
                'check_out'       => $request->check_out,
                'rooms'           => $request->rooms,
                'nights'          => $nights,
                'price_per_night' => $room->price_per_night,
                'total_price'     => $subtotal,
            ]);

            return $booking;
        });

        return redirect()
            ->route('v1.payment.show', $booking->id)
            ->with('success', 'Hotel booking created successfully! Please complete the payment.');
    }

    // ─────────────────────────────────────────────
    //  BOOKING — TRANSPORT
    // ─────────────────────────────────────────────

    /**
     * Proses booking transportasi.
     * POST /v1/booking/transport
     */
    public function bookTransport(Request $request)
    {
        $request->validate([
            'transportation_id' => 'required|exists:transportation,id',
            'persons'           => 'required|integer|min:1|max:50',
            'pickup_location'   => 'required|string|max:255',
            'dropoff_location'  => 'nullable|string|max:255',
            'contact_name'      => 'required|string|max:100',
            'contact_phone'     => 'required|string|max:20',
            'contact_email'     => 'required|email',
            'special_request'   => 'nullable|string|max:500',
        ]);

        $transport = Transportation::findOrFail($request->transportation_id);

        if (!$transport->is_active) {
            return back()->withErrors(['transportation_id' => 'Transportation is not available.'])->withInput();
        }

        // Cek ketersediaan kuota (jumlah penumpang yang sudah memesan pada rentang tanggal yg sama)
        $bookedPersons = $transport->bookings()
            ->whereHas('booking', fn($q) => $q
                ->whereNotIn('status', ['cancelled', 'refunded'])
            )->sum('days'); // 'days' kolom dipakai juga utk menyimpan jumlah penumpang per booking

        $availableSeats = $transport->quota - $bookedPersons;
        if ($request->persons > $availableSeats) {
            return back()->withErrors(['transportation_id' => "Only {$availableSeats} seats available for the selected date."])->withInput();
        }

        $persons    = (int) $request->persons;
        $subtotal   = $transport->price_per_person * $persons;
        $tax        = $subtotal * 0.11;
        $grandTotal = $subtotal + $tax;

        $booking = DB::transaction(function () use ($request, $transport, $subtotal, $tax, $grandTotal, $persons) {
            $booking = Booking::create([
                'user_id'       => auth()->id(),
                'type'          => 'transport',
                'status'        => 'pending',
                'subtotal'      => $subtotal,
                'tax'           => $tax,
                'total_price'   => $grandTotal,
                'total_persons' => $persons,
                'contact_name'  => $request->contact_name,
                'contact_phone' => $request->contact_phone,
                'contact_email' => $request->contact_email,
                'notes'         => $request->special_request,
                'tax'           => $tax,
                'total_price'   => $grandTotal,
            ]);

            $booking->transports()->create([
                'transportation_id' => $transport->id,
                'days'              => $persons, // jumlah penumpang
                'price_per_day'     => $transport->price_per_person,
                'total_price'       => $subtotal,
                'pickup_location'   => $request->pickup_location,
                'dropoff_location'  => $request->dropoff_location,
                'special_request'   => $request->special_request,
            ]);

            return $booking;
        });

        return redirect()
            ->route('v1.payment.show', $booking->id)
            ->with('success', 'Transport booking created successfully! Please complete the payment.');
    }

    // ─────────────────────────────────────────────
    //  CANCEL BOOKING
    // ─────────────────────────────────────────────

    /**
     * Batalkan booking.
     * PUT /v1/booking/{id}/cancel
     */
    public function cancel(string $id)
    {
        $booking = Booking::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        if (!in_array($booking->status, ['pending', 'confirmed'])) {
            return back()->withErrors(['cancel' => 'Booking cannot be cancelled.']);
        }

        $booking->update(['status' => 'cancelled']);

        return redirect()
            ->route('v1.booking.index')
            ->with('success', 'Booking successfully cancelled.');
    }

    // ─────────────────────────────────────────────
    //  BACKEND ADMIN
    // ─────────────────────────────────────────────

    /**
     * Daftar semua booking (backend).
     */
    public function index()
    {
        $bookings = Booking::with(['user', 'payments'])
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('backend.v_booking.index', compact('bookings'));
    }

    /**
     * Detail booking (backend).
     */
    public function show(string $id)
    {
        $booking = Booking::with([
            'user',
            'packages.travelPackage',
            'hotels.hotel',
            'hotels.room',
            'transports.transportation',
            'payments',
        ])->findOrFail($id);

        return view('backend.v_booking.show', compact('booking'));
    }

    /**
     * Update status booking (backend).
     */
    public function updateStatus(Request $request, string $id)
    {
        $booking = Booking::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,confirmed,in_progress,completed,cancelled,refunded',
        ]);

        $booking->update(['status' => $request->status]);

        return redirect()
            ->back()
            ->with('success', 'Booking updated.');
    }

     // ─────────────────────────────────────────────
    //  LAPORAN (REPORT) — BACKEND
    // ─────────────────────────────────────────────

    /**
     * Form pilih rentang tanggal untuk laporan booking.
     */
    public function formBooking()
    {
        return view('backend.v_booking.form', [
            'judul' => 'Booking Report',
        ]);
    }

    /**
     * Cetak laporan booking berdasarkan rentang tanggal.
     */
    public function printBooking(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
        ], [
            'start_date.required'    => 'Start Date is required.',
            'end_date.required'      => 'End Date is required.',
            'end_date.after_or_equal'=> 'End Date must be the same day or later than Start Date.',
        ]);

        $startdate = $request->input('start_date');
        $enddate   = $request->input('end_date');

        $booking = Booking::with('user')
            ->whereBetween('created_at', [$startdate, $enddate])
            ->orderBy('id', 'desc')
            ->get();

        return view('backend.v_booking.print', [
            'judul'     => 'Booking Report',
            'startdate' => $startdate,
            'enddate'   => $enddate,
            'cetak'     => $booking,
        ]);
    }

}
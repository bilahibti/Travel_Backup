<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;
use App\Models\TravelPackages as Paket;
use App\Models\Hotel;
use App\Models\Transportation;
use App\Models\Booking;
use App\Models\User;

class DashboardController extends Controller
{
    public function dashboardBackend()
    {
        // ── Data untuk tabel (Admin & Staff) ──────────────────────────────
        $paket          = Paket::with('destination')->get();
        $hotel          = Hotel::with('destination')->get();
        $transportation = Transportation::with('departureDestination', 'arrivalDestination')->get();
        $destination    = Destination::all();

        // ── Statistik ringkasan (Admin only) ─────────────────────────────
        $totalBookings      = Booking::count();
        $pendingBookings    = Booking::pending()->count();
        $confirmedBookings  = Booking::confirmed()->count();
        $completedBookings  = Booking::completed()->count();
        $cancelledBookings  = Booking::cancelled()->count();
        $totalRevenue       = Booking::where('status', 'completed')->sum('total_price');
        $totalUsers         = User::count();
        $totalDestinations  = Destination::count();

        // ── Booking terbaru (Admin) ────────────────────────────────────────
        $recentBookings = Booking::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // ── Booking pending (Staff) ───────────────────────────────────────
        $pendingBookingList = Booking::with('user')
            ->pending()
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('backend.v_dashboard.index', compact(
            'paket',
            'hotel',
            'transportation',
            'destination',
            'totalBookings',
            'pendingBookings',
            'confirmedBookings',
            'completedBookings',
            'cancelledBookings',
            'totalRevenue',
            'totalUsers',
            'totalDestinations',
            'recentBookings',
            'pendingBookingList'
        ));
    }

    /**
     * Frontend dashboard
     */
    public function index()
    {
        $destination = Destination::where('status', 'Available')->orderBy('updated_at', 'desc')->paginate(6);

        $countryGroups = Destination::where('status', 'Available')
            ->get()
            ->groupBy('country')
            ->map(function ($items) {
                return $items->groupBy('city')->map->count();
            });

        $countries = $countryGroups->keys()->sort()->values();

        $featuredPackages = Paket::with('destination')
            ->where('status', 'Available')
            ->latest()
            ->take(3)
            ->get();

        return view('frontend.v_dashboard.index', [
            'judul'             => 'Halaman Beranda',
            'destination'       => $destination,
            'countryGroups'     => $countryGroups,
            'countries'         => $countries,
            'totalDestinations' => Destination::count(),
            'totalCountries'    => $countries->count(),
            'totalHotels'       => Hotel::count(),
            'totalPackages'     => Paket::count(),
            'featuredPackages'  => $featuredPackages,
        ]);
    }
}
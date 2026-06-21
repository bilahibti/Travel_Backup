<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TravelPackages;
use App\Models\Destination;
use App\Models\Hotel;
use App\Models\Transportation;
use App\Helpers\ImageHelper;

class TravelPackagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $travelpackages = TravelPackages::orderBy('updated_at', 'desc')->get(); 
        return view('backend.v_travel-packages.index', [ 
            'judul' => 'Travel Packages', 
            'index' => $travelpackages
        ]); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $destination = Destination::orderBy('destination_name', 'asc')->get();
        $hotel = Hotel::orderBy('hotel_name', 'asc')->get(); 
        $transportation = Transportation::orderBy('transportation_name', 'asc')->get();
        return view('backend.v_travel-packages.create', [ 
            'destination' => $destination,
            'hotel' => $hotel,
            'transportation' => $transportation
        ]); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([ 
            'destination_id' => 'required|exists:destination,id',
            'hotel_id' => 'required|exists:hotel,id',
            'transportation_id' => 'required|exists:transportation,id',
            'packages_name' => 'required|string|max:255',
            'description' => 'required',
            'price_packages' => 'required|numeric',
            'package_type' => 'required|in:Domestic,International',
            'include' => 'required',
            'exclude' => 'required',
            'quota' => 'required|integer|min:1',
            'status' => 'required|in:Available,Full Booked',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png',

        ],
        $messages = [ 
            'foto.image' => 'The image must be a file of type: jpeg, jpg, png, or gif.',
            'foto.max' => 'The maximum image size allowed is 1024 KB.'
        ]);

        if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $directory = 'img-package';
        ImageHelper::uploadAndResize($file, $directory, $originalFileName);
        $validatedData['foto'] = $originalFileName;}

        TravelPackages::create($validatedData); 
        return redirect()->route('v1.backend.travel-packages.index')->with('success', 'Data successfully saved'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $travelPackages = TravelPackages::findOrFail($id);

        $destinations = Destination::all();
        $hotels = Hotel::all();
        $transportations = Transportation::all();

        return view('backend.v_travel-packages.edit', [
            'edit' => $travelPackages,
            'destinations' => $destinations,
            'hotels' => $hotels,
            'transportations' => $transportations
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //ddd($request); 
        $travelPackages = TravelPackages::findOrFail($id); 
        $validatedData = $request->validate([
            'destination_id' => 'required|exists:destination,id',
            'hotel_id' => 'required|exists:hotel,id',
            'transportation_id' => 'required|exists:transportation,id',
            'packages_name' => 'required|string|max:255',
            'description' => 'required',
            'price_packages' => 'required|numeric',
            'package_type' => 'required|in:Domestic,International',
            'include' => 'required',
            'exclude' => 'required',
            'quota' => 'required|integer|min:1',
            'status' => 'required|in:Available,Full Booked',
        ],
        $messages = [ 
            'foto.image' => 'The image must be a file of type: jpeg, jpg, png, or gif.',
            'foto.max' => 'The maximum image size allowed is 1024 KB.'
        ]);

        // menggunakan ImageHelper 
        if ($request->file('foto')) { 
            //hapus gambar lama 
            if ($travelPackages->foto) { 
                $oldImagePath = public_path('storage/img-package/') . $travelPackages->foto; 
                if (file_exists($oldImagePath)) { 
                    unlink($oldImagePath); 
                } 
            } 
            $file = $request->file('foto'); 
            $extension = $file->getClientOriginalExtension(); 
            $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $extension; 
            $directory = 'img-package'; 
            // Simpan gambar dengan ukuran yang ditentukan 
            ImageHelper::uploadAndResize($file, $directory, $originalFileName, 385, 400); // null (jika tinggi otomatis) 
            // Simpan nama file asli di database 
            $validatedData['foto'] = $originalFileName; 
        }  

        $travelPackages->update($validatedData); 
        return redirect()->route('v1.backend.travel-packages.index')->with('success', 'Data successfully updated'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $travelpackages = TravelPackages::findOrFail($id); 
        $travelpackages ->delete(); 
        return redirect()->route('v1.backend.travel-packages.index')->with('success', 'Data successfully deleted'); 
    }

    public function frontendIndex(Request $request)
    {
        $query = TravelPackages::with(['destination', 'hotel', 'transportation'])
            ->where('status', 'Available');

        if ($request->filled('destination_id')) {
            $query->where('destination_id', $request->destination_id);
        }
        if ($request->filled('package_type')) {
            $query->where('package_type', $request->package_type);
        }

        $packages = $query->orderBy('updated_at', 'desc')->paginate(9)->withQueryString();
        $destinations = Destination::orderBy('destination_name')->get();
        $packageTypes = TravelPackages::distinct()->pluck('package_type');

        return view('frontend.v_tours.tours', compact('packages', 'destinations', 'packageTypes'));
    }

    public function frontendShow(string $id)
    {
        $package = TravelPackages::with(['destination', 'hotel', 'transportation'])
            ->findOrFail($id);

        return view('frontend.v_tours.show', compact('package'));
    }

     // ─────────────────────────────────────────────
    //  LAPORAN (REPORT) — BACKEND
    // ─────────────────────────────────────────────

    /**
     * Form pilih rentang tanggal untuk laporan travel package.
     */
    public function formTravelPackages()
    {
        return view('backend.v_travel-packages.form', [
            'judul' => 'Travel Package Report',
        ]);
    }

    /**
     * Cetak laporan travel package berdasarkan rentang tanggal.
     */
    public function printTravelPackages(Request $request)
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

        $travelpackages = TravelPackages::with('destination')
            ->whereBetween('created_at', [$startdate, $enddate])
            ->orderBy('id', 'desc')
            ->get();

        return view('backend.v_travel-packages.print', [
            'judul'     => 'Travel Package Report',
            'startdate' => $startdate,
            'enddate'   => $enddate,
            'cetak'     => $travelpackages,
        ]);
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;
use App\Helpers\ImageHelper;
use App\Models\TravelPackages;
use App\Models\Hotel;
use App\Models\Transportation;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $destination = Destination::orderBy('destination_name', 'asc')->get(); 
        return view('backend.v_destination.index', [ 
            'judul' => 'Destination', 
            'index' => $destination 
        ]); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.v_destination.create', [ 
            'judul' => 'Destination', 
        ]); 
    }

    /**
     * Store a newly created resource in storage.
     */
     public function store(Request $request) 
    { 
        $validatedData = $request->validate([ 
            'destination_name' => 'required|max:255',
            'country' => 'required|max:50', 
            'city' => 'required|max:50',
            'description' => 'required',
            'destination_type' => 'required|in:Domestic,International',
            'quota' => 'required|integer|min:1', 
            'status' => 'required|in:Available,Full Booked',  
            'foto' => 'image|mimes:jpeg,jpg,png,gif|file|max:1024',  
        ], $messages = [ 
            'foto.image' => 'The image must be a file of type: jpeg, jpg, png, or gif.',
            'foto.max' => 'The maximum image size allowed is 1024 KB.' 
        ]);  
 
        if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $directory = 'img-destination';
        ImageHelper::uploadAndResize($file, $directory, $originalFileName);
        $validatedData['foto'] = $originalFileName;
    }
        Destination::create($validatedData); 
        return redirect()->route('v1.backend.destination.index')->with('success', 'Data saved successfully');
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
        $destination = Destination::find($id); 
        return view('backend.v_destination.edit', [ 
            'judul' => 'Destination', 
            'edit' => $destination 
        ]); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //ddd($request); 
        $destination = Destination::findOrFail($id); 
        $validatedData = $request->validate([ 
            'destination_name' => 'required|max:255',
            'country' => 'required|max:50', 
            'city' => 'required|max:50',
            'description' => 'required',
            'destination_type' => 'required|in:Domestic,International',
            'quota' => 'required|integer|min:1', 
            'status' => 'required|in:Available,Full Booked',  
            'foto' => 'image|mimes:jpeg,jpg,png,gif|file|max:1024', 
        ],
        $messages = [ 
            'foto.image' => 'The image must be a file of type: jpeg, jpg, png, or gif.',
            'foto.max' => 'The maximum image size allowed is 1024 KB.' 
        ]); 
 
        // menggunakan ImageHelper 
        if ($request->file('foto')) { 
            //hapus gambar lama 
            if ($destination->foto) { 
                $oldImagePath = public_path('storage/img-destination/') . $destination->foto; 
                if (file_exists($oldImagePath)) { 
                    unlink($oldImagePath); 
                } 
            } 
            $file = $request->file('foto'); 
            $extension = $file->getClientOriginalExtension(); 
            $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $extension; 
            $directory = 'img-destination'; 
            // Simpan gambar dengan ukuran yang ditentukan 
            ImageHelper::uploadAndResize($file, $directory, $originalFileName, 385, 400); // null (jika tinggi otomatis) 
            // Simpan nama file asli di database 
            $validatedData['foto'] = $originalFileName; 
        } 
 
        $destination->update($validatedData); 
        return redirect()->route('v1.backend.destination.index')->with('success', 'Data successfully updated'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $destination = Destination::findOrFail($id); 
        $destination ->delete(); 
        return redirect()->route('v1.backend.destination.index')->with('success', 'Data successfully deleted'); 
    }

    public function frontendIndex(Request $request)
    {
        $query = Destination::where('status', 'Available');

        if ($request->filled('country')) {
            $query->where('country', $request->country);
        }
        if ($request->filled('destination_type')) {
            $query->where('destination_type', $request->destination_type);
        }
        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('destination_name', 'like', '%'.$request->q.'%')
                  ->orWhere('city', 'like', '%'.$request->q.'%');
            });
        }

        $destinations = $query->orderBy('destination_name')->paginate(9)->withQueryString();
        $countries = Destination::where('status', 'Available')->distinct()->orderBy('country')->pluck('country');

        return view('frontend.v_destination.destination', compact('destinations', 'countries'));
    }

    public function frontendShow(string $id)
    {
        $destination = Destination::findOrFail($id);
        $packages = TravelPackages::where('destination_id', $id)
            ->where('status', 'Available')
            ->get();
        $hotels = Hotel::where('destination_id', $id)
            ->where('status', 'Available')
            ->get();

        return view('frontend.v_destination.show', compact('destination', 'packages', 'hotels'));
    }
}

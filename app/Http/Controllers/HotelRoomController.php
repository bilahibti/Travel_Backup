<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HotelRoom;
use App\Models\Hotel;
use App\Helpers\ImageHelper;

class HotelRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hotelRooms = HotelRoom::with('hotel')
            ->orderBy('hotel_id', 'asc')
            ->get();

        return view('backend.v_hotel_room.index', [
            'judul' => 'Hotel Room',
            'index' => $hotelRooms,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hotels = Hotel::orderBy('hotel_name', 'asc')->get();

        return view('backend.v_hotel_room.create', [
            'judul'  => 'Hotel Room',
            'hotels' => $hotels,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'hotel_id'       => 'required|exists:hotel,id',
            'room_type'      => 'required|string|max:255',
            'capacity'       => 'required|integer|min:1',
            'price_per_night'=> 'required|numeric|min:0',
            'total_rooms'    => 'required|integer|min:1',
            'amenities'      => 'nullable|array',
            'amenities.*'    => 'string|max:100',
            'foto'           => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
        ], [
            'foto.image' => 'The image must be a file of type: jpeg, jpg, or png.',
            'foto.max'   => 'The maximum image size allowed is 1024 KB.',
        ]);

        if ($request->hasFile('foto')) {
            $file             = $request->file('foto');
            $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $directory        = 'img-hotel-room';
            ImageHelper::uploadAndResize($file, $directory, $originalFileName);
            $validatedData['foto'] = $originalFileName;
        }

        // amenities disimpan sebagai JSON array
        $validatedData['amenities'] = $request->input('amenities', []);

        HotelRoom::create($validatedData);

        return redirect()
            ->route('v1.backend.hotel-room.index')
            ->with('success', 'Data successfully saved');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $hotelRoom = HotelRoom::findOrFail($id);
        $hotels    = Hotel::orderBy('hotel_name', 'asc')->get();

        return view('backend.v_hotel_room.edit', [
            'judul'  => 'Hotel Room',
            'edit'   => $hotelRoom,
            'hotels' => $hotels,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $hotelRoom = HotelRoom::findOrFail($id);

        $validatedData = $request->validate([
            'hotel_id'       => 'required|exists:hotel,id',
            'room_type'      => 'required|string|max:255',
            'capacity'       => 'required|integer|min:1',
            'price_per_night'=> 'required|numeric|min:0',
            'total_rooms'    => 'required|integer|min:1',
            'amenities'      => 'nullable|array',
            'amenities.*'    => 'string|max:100',
            'foto'           => 'nullable|image|mimes:jpeg,jpg,png|max:1024',
        ], [
            'foto.image' => 'The image must be a file of type: jpeg, jpg, or png.',
            'foto.max'   => 'The maximum image size allowed is 1024 KB.',
        ]);

        if ($request->hasFile('foto')) {
            // Hapus foto lama
            if ($hotelRoom->foto) {
                $oldImagePath = public_path('storage/img-hotel-room/') . $hotelRoom->foto;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $file             = $request->file('foto');
            $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $directory        = 'img-hotel-room';
            ImageHelper::uploadAndResize($file, $directory, $originalFileName, 385, 400);
            $validatedData['foto'] = $originalFileName;
        }

        $validatedData['amenities'] = $request->input('amenities', []);

        $hotelRoom->update($validatedData);

        return redirect()
            ->route('v1.backend.hotel-room.index')
            ->with('success', 'Data successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hotelRoom = HotelRoom::findOrFail($id);

        // Hapus foto jika ada
        if ($hotelRoom->foto) {
            $imagePath = public_path('storage/img-hotel-room/') . $hotelRoom->foto;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $hotelRoom->delete();

        return redirect()
            ->route('v1.backend.hotel-room.index')
            ->with('success', 'Data successfully deleted');
    }
}

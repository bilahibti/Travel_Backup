<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelRoom extends Model
{
    protected $table = 'hotel_rooms';
    protected $fillable = ['hotel_id', 'room_type', 'capacity', 'price_per_night', 'total_rooms', 'amenities', 'foto'];
    protected $casts = ['amenities' => 'array'];

    public function hotel() { return $this->belongsTo(Hotel::class); }

    public function bookings()
    {
        return $this->hasMany(BookingHotel::class, 'hotel_room_id');
    }

    public function getAvailableRoomsForDate($checkIn, $checkOut): int
    {
        $booked = BookingHotel::where('hotel_room_id', $this->id)
            ->where(function ($q) use ($checkIn, $checkOut) {
                $q->whereBetween('check_in', [$checkIn, $checkOut])
                  ->orWhereBetween('check_out', [$checkIn, $checkOut]);
            })
            ->whereHas('booking', fn($q) => $q->whereNotIn('status', ['cancelled', 'refunded']))
            ->sum('rooms');

        return max(0, $this->total_rooms - $booked);
    }
}

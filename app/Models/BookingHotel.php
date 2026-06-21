<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingHotel extends Model
{
    protected $table = 'booking_hotel';
    protected $casts = [
        'check_in' => 'datetime',
        'check_out' => 'datetime',
    ];
    protected $fillable = ['booking_id', 'hotel_id', 'hotel_room_id', 'check_in', 'check_out', 'rooms', 'price_per_night', 'total_price'];

    public function booking() { return $this->belongsTo(Booking::class); }
    public function hotel() { return $this->belongsTo(Hotel::class); }
    public function room() { return $this->belongsTo(HotelRoom::class, 'hotel_room_id'); }
}

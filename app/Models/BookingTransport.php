<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingTransport extends Model
{
    protected $table = 'booking_transport';
    protected $fillable = [
        'booking_id', 'transportation_id', 
        'days', 'price_per_day', 'total_price',
        'pickup_location', 'dropoff_location', 'special_request',
    ];

    public function booking() { return $this->belongsTo(Booking::class); }
    public function transportation() { return $this->belongsTo(Transportation::class); }
}

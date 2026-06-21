<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transportation extends Model
{
    public $timestamps = false; 
    protected $table = "transportation"; 
    // protected $fillable = [nama_destinasi]; 
    protected $fillable = [
        'transportation_name',
        'transportation_type',
        'departure',
        'arrival',
        'departure_time',
        'arrival_time',
        'price_per_person',
        'quota',
        'booked',
        'status',
    ];

    public function departureDestination()
    {
        return $this->belongsTo(Destination::class, 'departure_destination_id');
    }

    public function arrivalDestination()
    {
        return $this->belongsTo(Destination::class, 'arrival_destination_id');
    }

    public function bookings()
    {
        return $this->hasMany(BookingTransport::class, 'transportation_id');
    }

    // Helper supaya cara cek ketersediaan konsisten dgn kolom "status" di DB
    public function getIsActiveAttribute(): bool
    {
        return $this->status === 'Available';
    }
}

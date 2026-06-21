<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    public $timestamps = true; 
    protected $table = "hotel"; 
    // protected $fillable = [nama_hotel]; 
    protected $fillable = [
        'destination_id',
        'hotel_name',
        'address',
        'description',
        'star_rating',
        'price_per_night',
        'facilities',
        'quota',
        'booked',
        'foto',
        'status',
    ]; 

    public function destination()
    {
        return $this->belongsTo(Destination::class, 'destination_id');
    }

    public function rooms()
    {
        return $this->hasMany(HotelRoom::class);
    }

    // Helper supaya cara cek ketersediaan konsisten dgn kolom "status" di DB
    public function getIsActiveAttribute(): bool
    {
        return $this->status === 'Available';
    }
}

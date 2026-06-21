<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingPackages extends Model
{
    protected $table = 'booking_packages';
    protected $fillable = ['booking_id', 'travel_package_id', 'persons', 'unit_price', 'packages_total_price'];

    public function booking() { return $this->belongsTo(Booking::class); }
    public function travelPackage() { return $this->belongsTo(TravelPackages::class, 'travel_package_id'); }
}

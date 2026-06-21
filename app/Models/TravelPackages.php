<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelPackages extends Model
{
    public $timestamps = true; 
    protected $table = "travel_packages"; 
    protected $fillable = [
        'destination_id',
        'hotel_id',
        'transportation_id',
        'packages_name',
        'description',
        'price_packages',
        'package_type',
        'include',
        'exclude',
        'quota',
        'booked',
        'status',
        'foto',
        'duration_days',   
        'max_persons',     
        'is_active',      
    ]; 

    public function destination()
    {
        return $this->belongsTo(Destination::class, 'destination_id');
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }

    public function transportation()
    {
        return $this->belongsTo(Transportation::class, 'transportation_id');
    }
}

<?php
// ════════════════════════════════════════════════════════════════════
//  app/Models/BookingPackages.php
// ════════════════════════════════════════════════════════════════════
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingPackages extends Model
{
    protected $table = 'booking_packages';

    protected $fillable = [
        'booking_id', 'travel_package_id', 'persons', 'unit_price', 'packages_total_price',
    ];

    protected $casts = [
        'unit_price'           => 'decimal:2',
        'packages_total_price' => 'decimal:2',
    ];

    public function booking()       { return $this->belongsTo(Booking::class); }
    public function travelPackage() { return $this->belongsTo(TravelPackages::class, 'travel_package_id'); }
}

// ════════════════════════════════════════════════════════════════════
//  app/Models/BookingHotel.php
// ════════════════════════════════════════════════════════════════════
// namespace App\Models;
// use Illuminate\Database\Eloquent\Model;

class BookingHotel extends Model
{
    protected $table = 'booking_hotel';

    protected $fillable = [
        'booking_id', 'hotel_id', 'hotel_room_id',
        'check_in', 'check_out', 'rooms', 'nights', 'price_per_night', 'total_price',
    ];

    protected $casts = [
        'check_in'        => 'date',
        'check_out'       => 'date',
        'price_per_night' => 'decimal:2',
        'total_price'     => 'decimal:2',
    ];

    public function booking() { return $this->belongsTo(Booking::class); }
    public function hotel()   { return $this->belongsTo(Hotel::class); }
    public function room()    { return $this->belongsTo(HotelRoom::class, 'hotel_room_id'); }
}

// ════════════════════════════════════════════════════════════════════
//  app/Models/BookingTransport.php
// ════════════════════════════════════════════════════════════════════
// namespace App\Models;
// use Illuminate\Database\Eloquent\Model;

class BookingTransport extends Model
{
    protected $table = 'booking_transport';

    protected $fillable = [
        'booking_id', 'transportation_id',
        'rental_date', 'return_date', 'days',
        'price_per_day', 'total_price',
        'pickup_location', 'dropoff_location', 'special_request',
    ];

    protected $casts = [
        'rental_date'   => 'date',
        'return_date'   => 'date',
        'price_per_day' => 'decimal:2',
        'total_price'   => 'decimal:2',
    ];

    public function booking()        { return $this->belongsTo(Booking::class); }
    public function transportation() { return $this->belongsTo(Transportation::class); }
}
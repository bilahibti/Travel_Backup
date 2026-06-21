<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'booking';

    protected $fillable = [
        'user_id', 'booking_code', 'type', 'status',
        'subtotal', 'discount', 'tax', 'total_price',
        'travel_date', 'return_date', 'total_persons',
        'notes', 'contact_name', 'contact_phone', 'contact_email',
    ];

    protected $casts = [
        'subtotal'    => 'decimal:2',
        'discount'    => 'decimal:2',
        'tax'         => 'decimal:2',
        'total_price' => 'decimal:2',
        'travel_date' => 'date',
        'return_date' => 'date',
    ];

    // ─── Auto-generate booking code ───
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($booking) {
            if (!$booking->booking_code) {
                $booking->booking_code = 'TRV-' . strtoupper(Str::random(10));
            }
        });
    }

    // ─── Relationships ───
    public function user()       { return $this->belongsTo(User::class); }
    public function packages()   { return $this->hasMany(BookingPackages::class); }
    public function hotels()     { return $this->hasMany(BookingHotel::class); }
    public function transports() { return $this->hasMany(BookingTransport::class); }
    public function payments()   { return $this->hasMany(Payment::class); }
    public function reviews()    { return $this->hasMany(Review::class); }

    // ─── Helpers ───
    public function isPaid(): bool
    {
        return $this->payments()->where('status', 'paid')->exists();
    }

    public function statusLabel(): string
    {
        return match($this->status) {
            'pending'     => 'Menunggu Pembayaran',
            'confirmed'   => 'Dikonfirmasi',
            'in_progress' => 'Sedang Berlangsung',
            'completed'   => 'Selesai',
            'cancelled'   => 'Dibatalkan',
            'refunded'    => 'Refund',
            default       => ucfirst($this->status),
        };
    }

    public function statusBadgeClass(): string
    {
        return match($this->status) {
            'pending'     => 'warning',
            'confirmed'   => 'primary',
            'in_progress' => 'info',
            'completed'   => 'success',
            'cancelled'   => 'danger',
            'refunded'    => 'secondary',
            default       => 'secondary',
        };
    }

    public function typeLabel(): string
    {
        return match($this->type) {
            'package'   => 'Paket Wisata',
            'hotel'     => 'Hotel',
            'transport' => 'Transportasi',
            default     => ucfirst($this->type),
        };
    }

    // ─── Scopes ───
    public function scopePending($query)    { return $query->where('status', 'pending'); }
    public function scopeConfirmed($query)  { return $query->where('status', 'confirmed'); }
    public function scopeCompleted($query)  { return $query->where('status', 'completed'); }
    public function scopeCancelled($query)  { return $query->where('status', 'cancelled'); }
}
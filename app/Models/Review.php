<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'review';
    protected $fillable = ['user_id', 'booking_id', 'reviewable_type', 'reviewable_id', 'rating', 'comment', 'images', 'is_published'];
    protected $casts = ['images' => 'array', 'is_published' => 'boolean'];

    public function user() { return $this->belongsTo(User::class); }
    public function booking() { return $this->belongsTo(Booking::class); }
    public function reviewable() { return $this->morphTo(); }
}

<?php 

namespace App\Models; 
use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model; 

class Destination extends Model 
{ 
    public $timestamps = false; 
    protected $table = "destination"; 
    // protected $fillable = [destination_name]; 
    protected $fillable = [
        'destination_name',
        'country',
        'city',
        'description',
        'destination_type',
        'quota',
        'booked',
        'status',
        'foto',
    ]; 
}


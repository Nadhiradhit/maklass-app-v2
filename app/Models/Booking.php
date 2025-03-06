<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Booking extends Model
{

    use HasFactory;

    //
    protected $table = 'booking_class';

    protected $fillable = [

    ];

    // Relation Between Booking and Room
    public function room(): HasMany
    {
        return $this->hasMany(Room::class);
    }
}

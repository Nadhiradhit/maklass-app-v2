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
        'date_booking',
        'time_booking',
        'status',
        'user_id',
        'room_class_id',
    ];

    // Relation Between Booking and Room
    public function room(): HasMany
    {
        return $this->hasMany(Room::class);
    }

    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }
}

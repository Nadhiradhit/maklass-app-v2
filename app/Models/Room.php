<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Room extends Model
{
    use HasFactory;
    //
    protected $table = 'room_class';

    protected $fillable = [
        'room',
        'name',
        'floor',
        'status',
    ];

    public function booking(): HasOne{
        return $this->hasOne(Booking::class);
    }
}

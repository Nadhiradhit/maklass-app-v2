<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function booking(): HasMany{
        return $this->hasMany(Booking::class);
    }
}

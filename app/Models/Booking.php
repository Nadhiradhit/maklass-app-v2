<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{

    use HasFactory;

    //
    protected $table = 'booking_laboratory';

    protected $fillable = [
        'activity',
        'responsible',
        'date_booking',
        'time_booking',
        'status',
        'user_id',
        'room_laboratory_id',
        'file_attachment'
    ];

    // Relation Between Booking and Room
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'room_laboratory_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

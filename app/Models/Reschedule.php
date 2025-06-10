<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Booking;

class Reschedule extends Model
{
    //
    use HasFactory;

    protected $table = 'reschedule_laboratory';

    protected $fillable = [
        'id_booking',
        'date_reschedule',
        'time_reschedule',
        'reason',
        'status',
    ];

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'id_booking');
    }

}

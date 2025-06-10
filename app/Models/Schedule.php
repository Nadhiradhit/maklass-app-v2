<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Room;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Schedule extends Model
{
    protected $fillable = [
        'room_laboratory_id',
        'title_schedule',
        'description',
        'date',
        'schedule_start_datetime',
        'schedule_end_datetime',
        'status',
    ];

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'room_laboratory_id');
    }

}

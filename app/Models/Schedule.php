<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Room;

class Schedule extends Model
{
    protected $fillable = [
        'room_laboratory_id',
        'title_schedule',
        'description',
        'date',
        'start_time',
        'end_time',
        'status',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_laboratory_id');
    }

}

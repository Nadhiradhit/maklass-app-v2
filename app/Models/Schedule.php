<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Room;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Schedule extends Model
{
    use HasFactory;
    //
    protected $table = 'schedule_room';

    protected $fillable = [
        'room_laboratory_id',
        'semester_id',
        'title_schedule',
        'lecturer_name',
        'description',
        'schedule_day_of_week',
        'schedule_start_datetime',
        'schedule_end_datetime',
        'status',
    ];

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'room_laboratory_id');
    }

    public function semester(): BelongsTo
    {
        return $this->belongsTo(Semester::class, 'semester_id');
    }
}

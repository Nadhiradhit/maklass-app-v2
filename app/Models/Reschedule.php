<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reschedule extends Model
{
    //
    use HasFactory;

    protected $table = 'reschedule_class';

    protected $fillable = [
        'id_booking',
        'date_reschedule',
        'time_reschedule',
        'reason',
        'status',
    ];


}

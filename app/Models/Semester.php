<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Semester extends Model
{
    //
    use HasFactory;

    protected $table = 'semesters';

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'is_active',
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'semester_id');
    }

}

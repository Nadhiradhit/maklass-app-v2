<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(){
        // $data = \App\Models\Schedule::all();
        $title = 'Jadwal Lab';
        return view('landing.admin.schedule.dashboard-schedule', compact( 'title'));
    }
}

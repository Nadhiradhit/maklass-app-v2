<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScheduleDashboardController extends Controller
{
    //
    public function index(){
        return view('landing.user.schedule.dashboard-schedule');
    }
}

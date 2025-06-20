<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Schedule;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function index(){

        $roomData = Room::all();
        $bookingData = Booking::with(['user', 'room'])->where('user_id', Auth::id())->limit(5)->get();
        $schedule = Schedule::with(['room', 'semester'])->limit(3)->get();
        return view('landing.user.dashboard' , compact('roomData', 'bookingData', 'schedule'));
    }
}

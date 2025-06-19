<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function index(){

        $roomData = \App\Models\Room::all();
        $bookingData = Booking::with(['user', 'room'])->where('user_id', Auth::id())->get();
        return view('landing.user.dashboard' , compact('roomData', 'bookingData'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Schedule;
use App\Models\Room;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function index(){

        $roomData = Room::all();
        $activeBookedRoomIds = Booking::where(function ($query) {
                                    $query->where('booking_start_datetime', '<=', Carbon::now())
                                          ->where('booking_end_datetime', '>=', Carbon::now());
                                })
                                ->pluck('room_laboratory_id')
                                ->unique();

        $occupiedRoomsCount = $activeBookedRoomIds->count();
        $emptyRoomsCount = $roomData->count() - $occupiedRoomsCount;


        $bookingDataNotification = Booking::with(['user', 'room'])->where('user_id', Auth::id())->where('status', 'pending')->limit(3)->get();

        $schedule = Schedule::with(['room', 'semester'])->where(function ($query) use ($activeBookedRoomIds) { $query->whereIn('room_laboratory_id', $activeBookedRoomIds); })->limit(3)->get();
        return view('landing.user.dashboard' , compact('roomData', 'bookingDataNotification', 'schedule', 'emptyRoomsCount', 'occupiedRoomsCount'));
    }
}

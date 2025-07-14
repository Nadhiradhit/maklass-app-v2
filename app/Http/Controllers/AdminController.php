<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Booking;
use Carbon\Carbon;
class AdminController extends Controller
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

        $data = Booking::with(['user', 'room'])->where('status', 'pending')->limit(5)->get();
        $totalPendingBookingsCount = Booking::where('status', 'pending')->count();

        return view('landing.admin.dashboard', compact('data', 'totalPendingBookingsCount', 'emptyRoomsCount', 'occupiedRoomsCount'));
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Booking;
class AdminController extends Controller
{
    //
    public function index(){
        $data = Booking::with(['user', 'room'])->where('status', 'pending')->limit(5)->get();
        $totalPendingBookingsCount = Booking::where('status', 'pending')->count();
        $laboratories = Room::all();
        return view('landing.admin.dashboard', compact('data', 'laboratories', 'totalPendingBookingsCount'));
    }

}

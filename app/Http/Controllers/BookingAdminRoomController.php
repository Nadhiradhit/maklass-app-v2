<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;

class BookingAdminRoomController extends Controller
{
    //

    public function index()
    {
        $data = Booking::with(['user', 'room'])->get();
        return view('landing.admin.request.room.request-room', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $booking = Booking::findOrFail($id);
        $booking->update($validated);

        return redirect()->back()->with('success', 'Booking status updated successfully');
    }


}

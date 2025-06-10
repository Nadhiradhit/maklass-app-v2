<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BookingUserRoomController extends Controller
{
    public function index()
    {
        $data = Booking::with(['user', 'room'])->get();
        $laboratories = Room::all();

        return view('landing.user.room.room-booking', compact('data', 'laboratories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'booking_purpose' => 'required|string|max:255',
            'responsible' => 'required|string|max:255',
            'purpose' => 'required|string|max:255',
            'date_booking' => 'required|date',
            'time_booking' => 'required',
            'room_laboratory_id' => 'required|exists:room_laboratory,id',
            'file_attachment' => 'nullable|file|max:10240'
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'pending';

        if ($request->hasFile('file_attachment')) {
            $file = $request->file('file_attachment');
            $file_ext = $file->extension();
            $file_slug = Str::of($request->booking_purpose);
            $file_name = 'Booking_' . $file_slug . '.' . $file_ext;
            $file->move(public_path('storage/attachments'), $file_name);
            $validated['file_attachment'] = $file_name;
        }

        $booking = Booking::create($validated);
        $booking->save();

        return redirect()->back()->with('success', 'Booking request submitted successfully');
    }
}

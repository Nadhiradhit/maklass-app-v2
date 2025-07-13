<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Booking;

class RoomController extends Controller
{
    //
    public function index (){
        $data = \App\Models\Room::all();
        $title = 'Monitoring Ruangan Lab';
        return view('landing.admin.room.dashboard-room', compact('data'));
    }

    public function create(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'location' => 'required',
            'capacity' => 'required|integer',
            'description' => 'required',
        ]);

        $room = Room::create($validated);
        $room->save();

        return redirect()->route('landing.admin.room.dashboard')
            ->with('success', 'Ruangan berhasil ditambahkan');
    }

    public function delete($id){
        $room = Room::find($id);
        $room->delete();
        return redirect()->route('landing.admin.room.dashboard')
            ->with('success', 'Ruangan berhasil dihapus');
    }

    public function update(Request $request, Room $room)
    {
        $hasActiveBooking = Booking::where('room_laboratory_id', $room->id)
                                    ->where('end_time', '>', now()) // Assuming end_time is a datetime column
                                    ->exists();

        if ($hasActiveBooking) {
            return redirect()->back()->with('error', 'This room cannot be updated because it currently has active bookings.');
        }

        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'capacity' => 'required|integer',
            'description' => 'required',
        ]);

        $room->update($request->all());

        return redirect()->route('landing.admin.room.dashboard')->with('success', 'Ruangan berhasil diupdate');
    }
}

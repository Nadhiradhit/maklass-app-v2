<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

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

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'location' => 'required',
            'capacity' => 'required|integer',
            'description' => 'required',
        ]);

        $room = Room::findOrFail($id);
        $room->name = $validated['name'];
        $room->location = $validated['location'];
        $room->capacity = $validated['capacity'];
        $room->description = $validated['description'];
        $room->save();

        return redirect()->route('landing.admin.room.dashboard')->with('success', 'Ruangan berhasil diupdate');
    }
}

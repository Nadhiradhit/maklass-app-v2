<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoomController extends Controller
{
    //
    public function index (){
        $data = \App\Models\Room::all();
        $title = 'Monitoring Ruangan Lab';
        return view('landing.admin.room.dashboard-room', compact('data'));
    }

    public function create(Request $request){
        $request->validate([
            'room' => 'required',
            'name' => 'required',
        ]);

        $room = new \App\Models\Room();
        $room->room = $request->room;
        $room->name = $request->name;
        $room->save();

        return redirect()->route('landing.admin.room.dashboard')
            ->with('success', 'Ruangan berhasil ditambahkan');
    }

    public function delete($id){
        $room = \App\Models\Room::find($id);
        $room->delete();
        return redirect()->route('landing.admin.room.dashboard')
            ->with('success', 'Ruangan berhasil dihapus');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'room' => 'required',
            'name' => 'required',
        ]);

        $room = \App\Models\Room::findOrFail($id);
        $room->room = $request->room;
        $room->name = $request->name;
        $room->save();

        return redirect()->route('landing.admin.room.dashboard')->with('success', 'Ruangan berhasil diupdate');
    }
}

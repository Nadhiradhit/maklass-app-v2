<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index(){

        $roomData = \App\Models\Room::all();

        return view('landing.user.dashboard' , compact('roomData'));
    }
}

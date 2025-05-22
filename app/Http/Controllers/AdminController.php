<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
class AdminController extends Controller
{
    //
    public function index(){
        $data = Room::all();
        return view('landing.admin.dashboard', compact('data'));
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserAdminController extends Controller
{
    public function index(){
        $data = \App\Models\User::all();
        $title = 'User';
        return view('landing.admin.user.dashboard-user', compact('data', 'title'));
    }

    public function create(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|string|email|max:255|unique:users,email|regex:/^[a-zA-Z0-9._%+-]+@polimedia\.ac\.id$/',
            'password' => 'required|min:8',
            'role' => 'required|in:admin,user',
        ]);

        $user = new \App\Models\User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();

        return redirect()->route('landing.admin.user.dashboard')->with('success', 'User berhasil ditambahkan');
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'regex:/^[a-zA-Z0-9._%+-]+@polimedia\.ac\.id$/',
                Rule::unique('users', 'email')->ignore($id),
            ],
            'password' => 'nullable|min:8',
            'role' => 'required|in:admin,user',
        ]);

        $user = \App\Models\User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->role = $request->role;
        $user->save();

        return redirect()->route('landing.admin.user.dashboard')->with('success', 'User berhasil diubah');
    }

    public function delete($id){
        $user = \App\Models\User::findOrFail($id);
        $user->delete();

        return redirect()->route('landing.admin.user.dashboard')->with('success', 'User berhasil dihapus');
    }

}

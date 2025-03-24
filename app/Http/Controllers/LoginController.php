<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function forgetPassword(){
        return view('auth.forget-password');
    }

    public function login(Request $request){
        Session::flash('email', $request->identifier);

        // Validate Request User Login
        $request->validate([
            'identifier' => 'required',
            'password' => 'required'
        ],[
            'identifier.required' => 'Email or NIM is required',
            'password.required' => 'Password is required',
        ]);

        // Find The User Login By Email OR NIM
        $userModel = new User();
        $user = $userModel->findForLogin($request->identifier);

        if($user && Auth::attempt(['email' => $user->email, 'password' => $request->password])){

            // Authenticated Pass
            if($user->isAdmin()){
                return redirect()->route('admin.dashboard');
            }else{
                return redirect()->route('user.dashboard');
            }
        }

        // Authenticated Fail
        return back()->withErrors([
            'identifier' => 'Email or NIM is invalid'
        ]);

    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}

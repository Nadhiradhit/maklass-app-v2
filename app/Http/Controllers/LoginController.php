<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function login(Request $request){
        Session::flash('email', $request->identifier);

        // Validate Request User Login
        $request->validate([
            'identifier' => ['required', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@polimedia\.ac\.id$/'],
            'password' => 'required'
        ],[
            'identifier.required' => 'Email Polimedia Anda Tidak Boleh Kosong',
            'identifier.email' => 'Format Email Polimedia Anda Tidak Valid',
            'identifier.regex' => 'Email Harus Menggunakan Domain @polimedia.ac.id',
            'password.required' => 'Password Anda Tidak Boleh Kosong',
        ]);

        $remember = $request->has('remember');

        // Find The User Login By Email Polimedia
        $userModel = new User();
        $user = $userModel->findForLogin($request->identifier);

        if($user && Auth::attempt(['email' => $user->email, 'password' => $request->password], $remember)){

            $request->session()->regenerate();
            // Authenticated Pass
            if($user->isAdmin()){
                return redirect()->route('landing.admin.dashboard');
            }else{
                return redirect()->route('landing.user.dashboard');
            }
        }

        // Authenticated Fail
        return back()->withErrors([
            'identifier' => 'Email Polimedia Atau Password Anda Tidak Valid'
        ]);
    }

    public function logout(){
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function forgetPassword(){
        return view('auth.forget-password');
    }

    public function resetPassword(){
        return view('auth.reset-password');
    }

    public function updatePassword(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|confirmed|min:8',
        ],[
            'email.required' => 'Email Polimedia Anda Tidak Boleh Kosong',
            'email.email' => 'Format Email Polimedia Anda Tidak Valid',
            'email.exists' => 'Email Polimedia Anda Tidak Terdaftar',
            'password.required' => 'Password Anda Tidak Boleh Kosong',
            'password.confirmed' => 'Password Anda Tidak Sama',
            'password.min' => 'Password Anda Harus Memiliki Minimal 8 Karakter',
        ]);

        $user = User::where('email', $request->email)->where('email', 'like', '%@polimedia.ac.id')->first();

        // Verify Current Password
        // if(!Hash::check($request->current_password, $user->password)){
        //     return back()->withErrors([
        //         'current_password' => 'Current password is invalid'
        //     ]);
        // }

        // Update Password
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login')->with('success', 'Password Anda Berhasil Diubah');

    }

    public function register(){
        return view('auth.register');
    }

    public function handleRegister(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email|regex:/^[a-zA-Z0-9._%+-]+@polimedia\.ac\.id$/',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email must be a valid email address',
            'email.unique' => 'Email is already registered',
            'email.regex' => 'Email must be a valid polimedia.ac.id email',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 8 characters',
            'password.confirmed' => 'Passwords do not match',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        Auth::login($user);

        return redirect()->route('landing.user.dashboard')->with('success', 'Registration successful!');
    }

}

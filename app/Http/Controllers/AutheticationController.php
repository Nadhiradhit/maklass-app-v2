<?php

namespace App\Http\Controllers;

use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AutheticationController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function forgetPassword(){
        return view('auth.forget-password');
    }

    public function login(Request $request){
        Session::flash('email', $request -> email);

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ],[
            'email.required' => 'Email Wajib Diisi',
            'email.email' => 'Email tidak valid',
            'password.required' => 'Password wajib diisi',
        ]);

        $credentials = [
            'email' => 'Email Tidak Valid',
            'password' => 'Password Tidak Valid',
        ];


    }

}

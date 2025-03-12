<?php

use App\Http\Controllers\AutheticationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


route::get('/login', [AutheticationController::class, "index"])->name('login');
route::get('/forget-password', [AutheticationController::class, "forgetPassword"])->name('forget-password');

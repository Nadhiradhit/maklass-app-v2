<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



// Login Route
route::get('/', [LoginController::class, "index"])->name('login');
route::post('/login', [LoginController::class, "login"])->name('login.submit');
route::post('/logout', [LoginController::class, "logout"])->name('logout');

// Forgot Password Route
route::get('/forget-password', [LoginController::class, "forgetPassword"])->name('forget-password');
route::post('/forget-password', [LoginController::class, "SendResetPassword"])->name('forget-password.send');
route::get('/reset-password', [LoginController::class, "resetPassword"])->name('reset-password');
route::post('/reset-password', [LoginController::class, "updatePassword"])->name('reset-password.submit');


// User Route
Route::middleware('user')->prefix('dashboard')->group(function () {
    Route::get('/', [UserController::class, "index"])->name('landing.user.dashboard');
});

// Admin Route
Route::middleware('admin')->prefix('dashboard-admin')->group(function () {
    Route::get('/', [AdminController::class, "index"])->name('landing.admin.dashboard');
});

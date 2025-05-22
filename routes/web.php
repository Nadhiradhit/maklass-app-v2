<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserAdminController;
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

// Register Route
route::get('/register', [LoginController::class, "register"])->name('register');
route::post('/register', [LoginController::class, "handleRegister"])->name('register.submit');


// User Route
Route::middleware('user')->prefix('dashboard')->group(function () {
    Route::get('/', [UserController::class, "index"])->name('landing.user.dashboard');
});

// Admin Route
Route::middleware('admin')->prefix('dashboard-admin')->group(function () {
    Route::get('/', [AdminController::class, "index"])->name('landing.admin.dashboard');

    // Room Routes
    Route::get('/room', [RoomController::class, "index"])->name('landing.admin.room.dashboard');
    Route::post('/room', [RoomController::class, "create"])->name('landing.admin.room.create');
    Route::delete('/room/{id}', [RoomController::class, "delete"])->name('landing.admin.room.delete');
    Route::put('/room/{id}', [RoomController::class, "update"])->name('landing.admin.room.update');

    // User Routes
    Route::get('/user', [UserAdminController::class, "index"])->name('landing.admin.user.dashboard');
});

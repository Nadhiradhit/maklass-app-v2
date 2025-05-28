<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingUserRoomController;
use App\Http\Controllers\BookingAdminRoomController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserAdminController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ScheduleDashboardController;
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

    // Room Routes
    Route::get('/booking', [BookingUserRoomController::class, "index"])->name('landing.user.room.room-booking');
    Route::post('/booking', [BookingUserRoomController::class, "store"])->name('landing.user.room.room-booking.store');

    // Schedule Dashboard
    Route::get('/schedule', [ScheduleDashboardController::class, "index"])->name('landing.user.schedule.dashboard');
});

// Admin Route
Route::middleware('admin')->prefix('dashboard-admin')->group(function () {
    Route::get('/', [AdminController::class, "index"])->name('landing.admin.dashboard');

    // Room Routes
    Route::get('/room', [RoomController::class, "index"])->name('landing.admin.room.dashboard');
    Route::post('/room', [RoomController::class, "create"])->name('landing.admin.room.create');
    Route::delete('/room/{id}', [RoomController::class, "delete"])->name('landing.admin.room.delete');
    Route::put('/room/{id}', [RoomController::class, "update"])->name('landing.admin.room.update');

    // Schedule Routes
    Route::get('/schedule', [ScheduleController::class, "index"])->name('landing.admin.schedule.dashboard');

    // Booking Routes
    Route::get('/booking', [BookingAdminRoomController::class, "index"])->name('landing.admin.booking.dashboard');
    Route::put('/booking/{id}', [BookingAdminRoomController::class, "update"])->name('landing.admin.booking.update');

    // User Routes
    Route::get('/user', [UserAdminController::class, "index"])->name('landing.admin.user.dashboard');
    Route::post('/user', [UserAdminController::class, "create"])->name('landing.admin.user.create');
    Route::put('/user/{id}', [UserAdminController::class, "update"])->name('landing.admin.user.update');
    Route::delete('/user/{id}', [UserAdminController::class, "delete"])->name('landing.admin.user.delete');
});

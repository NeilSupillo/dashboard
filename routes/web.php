<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PreboardingAttendanceController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('preboarding');
});

Route::get('/login', function () {
    return view('login_test');
});

Route::get('/register', function () {
    return view('register_test');
});

Route::controller(PreboardingAttendanceController::class)->group(function () {
    Route::get('api/get_preboarding_data', 'index_datatable')->name('get_preboarding');
    Route::post('api/store_preboarding_data', 'store')->name('store_preboarding');
});

Route::controller(UserController::class)->group(function() {
    Route::post('api/add_user', 'store')->name('add_user')->middleware('admin');
    Route::post('api/login_custom', 'login_user_custom')->name('login_custom');
    Route::post('api/login', 'login')->name('login');
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PreboardingAttendanceController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('table_test');
}); 

Route::get('/login', function () {
    return view('login_test');
});

Route::get('/register', function () {
    return view('register_test');
});

Route::controller(PreboardingAttendanceController::class)->group(function () {
    Route::get('api/get_preboarding', 'index_datatable')->name('get_preboarding');
    Route::post('api/store_preboarding', 'store')->name('store_preboarding');
    Route::put('api/update_preboarding', 'update')->name('update_preboarding');
});

Route::controller(UserController::class)->group(function() {
    Route::post('api/add_user', 'store')->name('add_user');
    Route::post('api/login_custom', 'login_user_custom')->name('login_custom');
    Route::post('api/login', 'login')->name('login');
});

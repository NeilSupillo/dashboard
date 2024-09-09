<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PreboardingAttendanceController;

Route::get('/', function () {
    return view('dashboard');
});

Route::controller(PreboardingAttendanceController::class)->group(function () {
    Route::get('api/get_preboarding_data', 'index_datatable')->name('get_preboarding');
    Route::post('api/store_preboarding_data', 'store')->name('store_preboarding');
});

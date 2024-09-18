<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PreboardingAttendanceController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\EnsureAdminPageAccess;
use App\Http\Middleware\EnsureAdminAPIAccess;
use App\Http\Middleware\CheckifAuthenticated;

Route::get('/', function () {
    return view('login');
})->name('login'); 

Route::get('/preboarding', function () {
    return view('table_test');
})->name('preboarding_dashboard');

Route::get('/register', function () {
    return view('register_test');
})->name('register');

Route::get('/update', function (){
    return view('update_test');
})->name('update')->middleware(['auth', EnsureAdminPageAccess::class]);

Route::controller(PreboardingAttendanceController::class)->group(function () {
    Route::get('api/get_preboarding', 'index_datatable')->name('get_preboarding');
    Route::post('api/store_preboarding', 'store')->name('store_preboarding');
    Route::put('api/update_preboarding', 'update')->name('update_preboarding');
    Route::delete('api/delete_preboarding', 'destroy')->name('delete_preboarding');
});

Route::controller(UserController::class)->group(function() {
    Route::post('api/add_user', 'store')->name('add_user')->middleware(['auth', EnsureAdminAPIAccess::class]);
    Route::put('api/update_password', 'update_password')->name('update_password')->middleware(['auth', EnsureAdminAPIAccess::class]);
    Route::post('api/login_custom', 'login_user_custom')->name('login_custom');
    Route::post('api/login', 'login')->name('login_user');
});

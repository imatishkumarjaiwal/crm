<?php

use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('login');
// });


Route::controller(UsersController::class)->group(function () {
    Route::get('/', 'signIn');
    Route::get('/signup', 'signUp');
    Route::post('/authentication', 'userAuthentication')->name('user.authentication');
    Route::get('/dashboard', 'dashboard')->name('admin.dashboard');
    Route::get('/logout', 'userLogout')->name('user.logout');
});
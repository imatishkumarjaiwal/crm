<?php

use App\Http\Controllers\StaffsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\WorksController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('login');
// });


// Public routes
Route::controller(UsersController::class)->group(function () {
    Route::get('/', 'signIn');
    Route::get('/signup', 'signUp');
    Route::post('/authentication', 'userAuthentication')->name('user.authentication');
    Route::get('/logout', 'userLogout')->name('user.logout');
});

// Admin routes with middleware
Route::middleware('admin')->group(function () {
    Route::controller(UsersController::class)->group(function () {
        Route::get('/dashboard', 'dashboard')->name('admin.dashboard');
        Route::get('/blank-page', 'blankPage')->name('admin.blankPage');
    });
    Route::controller(StaffsController::class)->group(function () {
        Route::get('/staffs', 'index')->name('admin.staff.index');
        Route::get('/staffs/add', 'manageStaff')->name('admin.staff.add');
        Route::post('/staff/insert', 'insertStaff')->name('admin.staff.insert');
        Route::get('/staffs/edit/{id}', 'manageStaff')->name('admin.staff.edit');
        Route::post('/staff/update', 'updateStaff')->name('admin.staff.update');
        Route::get('/get-staffs', 'getStaffs')->name('admin.staff.getStaffs');
        Route::get('/edit-staff/{id}', 'getStaffDataForEdit')->name('admin.staff.getStaffDataForEdit');
        Route::post('/delete-staff', 'deleteStaff')->name('admin.staff.deleteStaff');
    });
    Route::controller(WorksController::class)->group(function () {
        Route::get('/works', 'index')->name('admin.work.index');
        Route::post('/work/save', 'saveWork')->name('admin.work.save');
        Route::get('/get-works', 'getWorks')->name('admin.work.getWorks');
        Route::get('/get-work/{id}', 'getWork')->name('admin.work.getWork');
        Route::post('/work/delete', 'deleteWork')->name('admin.work.delete');
    });
});
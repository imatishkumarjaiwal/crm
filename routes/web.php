<?php

use App\Http\Controllers\HolidaysController;
use App\Http\Controllers\MstStaffController;
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
        Route::get('/dashboard', 'dashboard')->name('dashboard');
        Route::get('/blank-page', 'blankPage')->name('blankPage');
    });
    Route::controller(MstStaffController::class)->group(function () {
        Route::get('/mst_staffs', 'index')->name('mst_staff.index');
        Route::get('/mst_staffs/add', 'manageStaff')->name('mst_staff.add');
        Route::post('/mst_staff/insert', 'insertStaff')->name('mst_staff.insert');
        Route::get('/mst_staffs/edit/{id}', 'manageStaff')->name('mst_staff.edit');
        Route::post('/mst_staff/update', 'updateStaff')->name('mst_staff.update');
        Route::get('/get-mst_staffs', 'getStaffs')->name('mst_staff.getStaffs');
        Route::post('/delete-mst_staff', 'deleteStaff')->name('mst_staff.deleteStaff');
    });
    Route::controller(WorksController::class)->group(function () {
        Route::get('/works', 'index')->name('work.index');
        Route::post('/work/save', 'saveWork')->name('work.save');
        Route::get('/get-works', 'getWorks')->name('work.getWorks');
        Route::get('/get-work/{id}', 'getWork')->name('work.getWork');
        Route::post('/work/delete', 'deleteWork')->name('work.delete');
    });
    Route::controller(HolidaysController::class)->group(function () {
        Route::get('/holidays', 'index')->name('holiday.index');
        Route::post('/holiday/save', 'saveHoliday')->name('holiday.save');
        Route::get('/get-holiday', 'getHolidays')->name('holiday.getHolidays');
        Route::get('/get-holiday/{id}', 'getHoliday')->name('holiday.getHoliday');
        Route::post('/holiday/delete', 'deleteHoliday')->name('holiday.delete');
    });
});
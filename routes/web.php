<?php

use App\Http\Controllers\HolidaysController;
use App\Http\Controllers\MstParamController;
use App\Http\Controllers\MstStaffController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\MstWorksController;
use App\Http\Controllers\MstStatusController;
use App\Http\Controllers\MstClientsController;
use App\Http\Controllers\TrnJobsController;
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
    Route::controller(MstParamController::class)->group(function () {
        Route::get('/mst_param', 'index')->name('mst_param.index');
        Route::post('/mst_param/update', 'updateParams')->name('mst_param.update');
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
    Route::controller(MstWorksController::class)->group(function () {
        Route::get('/mst_works', 'index')->name('mst_works.index');
        Route::post('/mst_works/save', 'saveMstWorks')->name('mst_works.save');
        Route::get('/get-mst_works', 'getMstWorksRecords')->name('mst_works.getMstWorksRecords');
        Route::get('/get-mst_works/{id}', 'getMstWorks')->name('mst_works.getMstWorks');
        Route::post('/mst_works/delete', 'deleteMstWorks')->name('mst_works.delete');
    });
    Route::controller(HolidaysController::class)->group(function () {
        Route::get('/holidays', 'index')->name('holiday.index');
        Route::post('/holiday/save', 'saveHoliday')->name('holiday.save');
        Route::get('/get-holiday', 'getHolidays')->name('holiday.getHolidays');
        Route::get('/get-holiday/{id}', 'getHoliday')->name('holiday.getHoliday');
        Route::post('/holiday/delete', 'deleteHoliday')->name('holiday.delete');
    });

    Route::controller(MstStatusController::class)->group(function () 
    {
        Route::get('/mst_status', 'index')->name('mst_status.index');
        Route::post('/mst_status/save', 'saveMstStatus')->name('mst_status.save');
        Route::get('/get-mst_status', 'getMstStatusRecords')->name('mst_status.getMstStatusRecords');
        Route::get('/get-mst_status/{id}', 'getMstStatus')->name('mst_status.getMstStatus');
        Route::post('/mst_status/delete', 'deleteMstStatus')->name('mst_status.delete');
    });

    Route::controller(MstClientsController::class)->group(function () {
        Route::get('/mst_clients', 'index')->name('mst_clients.index');
        Route::get('/mst_clients/add', 'manageClients')->name('mst_clients.add');
        Route::post('/mst_clients/insert', 'insertClients')->name('mst_clients.insert');
        Route::get('/mst_clients/edit/{id}', 'manageClients')->name('mst_clients.edit');
        Route::post('/mst_clients/update', 'updateClients')->name('mst_clients.update');
        Route::get('/get-mst_clients', 'getClients')->name('mst_clients.getClients');
        Route::post('/delete-mst_clients', 'deleteClients')->name('mst_clients.deleteStaff');
    });

    Route::controller(TrnJobsController::class)->group(function () {
        Route::get('/trn_jobs', 'index')->name('trn_jobs.index');
        Route::get('/trn_jobs/add', 'manageJobs')->name('trn_jobs.add');
        Route::get('/get-trn_jobs', 'getTrnJobRecords')->name('trn_jobs.getTrnJobRecords');
        Route::post('/trn_jobs/insert', 'insertJob')->name('trn_jobs.insert');
        Route::get('/trn_jobs/edit/{id}', 'manageJobs')->name('trn_jobs.edit');
        Route::post('/trn_jobs/update', 'updateJob')->name('trn_jobs.update');
        Route::post('/delete-trn_jobs', 'deleteJobs')->name('trn_jobs.delete');
    });

});
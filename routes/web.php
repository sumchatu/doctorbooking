<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth','prevent-back-history'])->group(function(){

    //For Admin routes
    Route::middleware('admin')->group(function(){

        Route::resource('/admin',AdminController::class);
        Route::get('/admin/doctor/book-appointment/{id}',[AdminController::class, 'bookAppointment'])->name('book.appointment');
        Route::post('/admin/doctor/book-appointment',[AdminController::class, 'appointmentSave'])->name('appointment.save');


    });


});

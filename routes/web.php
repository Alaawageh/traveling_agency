<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\TravelingController;
use App\Http\Controllers\Users\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth:web');

Route::group(['perfix' => 'traveling'],function(){
    Route::get('/about/{id}', [TravelingController::class, 'index'])->name('traveling.about');
    Route::get('/reservation/{id}', [TravelingController::class, 'makeReservations'])->name('traveling.reservation');
    Route::post('/reservation/{id}', [TravelingController::class, 'storeReservations'])->name('traveling.reservation.store');
    //pay
    Route::get('/pay',[TravelingController::class,'pay'])->name('traveling.pay')->middleware('check.price');
    Route::get('/success',[TravelingController::class,'success'])->name('traveling.success')->middleware('check.price');


    //Deals
    Route::get('/deals',[TravelingController::class,'deals'])->name('traveling.deals');
    Route::any('/search',[TravelingController::class,'search'])->name('traveling.search');
});

Route::get('users/My-bookings',[UserController::class,'bookings'])->name('users.bookings')->middleware('auth:web');

//Admin Panel
Route::get('admin/login',[AdminController::class,'viewLogin'])->name('admin.login')->middleware('check.auth');
Route::post('admin/login',[AdminController::class,'CheckLogin'])->name('admin.CheckLogin');

Route::group(['perfix' => 'admin' , 'middleware' => 'auth:admin'],function(){
    Route::get('/index',[AdminController::class,'index'])->name('admin.dashboard');

    Route::get('/all-admins',[AdminController::class,'allAdmin'])->name('admin.all.admins');
    Route::get('/create-admin',[AdminController::class,'createAdmin'])->name('admin.create.admin');
    Route::post('/create-admin',[AdminController::class,'storeAdmin'])->name('admin.store.admin');

    Route::get('/all-countries',[AdminController::class,'allCountries'])->name('admin.all.countries');
    Route::get('/create-country',[AdminController::class,'createCountry'])->name('admin.create.country');
    Route::post('/create-country',[AdminController::class,'storeCountry'])->name('admin.store.country');
    Route::get('/delete-country/{id}',[AdminController::class,'deleteCountry'])->name('admin.delete.country');

    Route::get('/all-cities',[AdminController::class,'allCities'])->name('admin.all.cities');
    Route::get('/create-city',[AdminController::class,'createCity'])->name('admin.create.city');
    Route::post('/create-city',[AdminController::class,'storeCity'])->name('admin.store.city');
    Route::get('/delete-city/{id}',[AdminController::class,'deleteCity'])->name('admin.delete.city');

    Route::get('/all-bookings',[AdminController::class,'allBookings'])->name('admin.all.bookings');
    Route::get('/edit-booking/{id}',[AdminController::class,'editBooking'])->name('admin.edit.booking');
    Route::post('/update-booking/{id}',[AdminController::class,'updateBooking'])->name('admin.update.booking');
    Route::get('/delete-booking/{id}',[AdminController::class,'deleteBooking'])->name('admin.delete.booking');


});



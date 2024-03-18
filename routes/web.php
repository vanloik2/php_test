<?php

use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ReservationController::class, 'show']);
Route::get('/restaurants', [ReservationController::class, 'filterRestaurantsByMeal']);
Route::get('/dishes', [ReservationController::class, 'filterDishesByRes']);
Route::get('/validate-step-3', [ReservationController::class, 'validateStep3']);
Route::post('/', [ReservationController::class, 'submitReservation']);
Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations');

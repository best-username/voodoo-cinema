<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AvailabilityController;

Route::get('getAllDates', [AvailabilityController::class, 'index']);
Route::get('checkAvailability/{availability}/{time}', [AvailabilityController::class, 'show']);
Route::post('saveBooking', [BookingController::class, 'store']);

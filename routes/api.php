<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    // User APIs
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // Event APIs
    Route::apiResource('events', EventController::class);

    // Ticket APIs
    Route::post('/events/{event}/tickets', [TicketController::class, 'store']);
    Route::apiResource('tickets', TicketController::class)->only(['update', 'destroy']);

    // Booking APIs
    Route::post('/tickets/{ticket}/bookings', [BookingController::class, 'store']);
    Route::get('/bookings', [BookingController::class, 'index']);
    Route::put('/bookings/{booking}/cancel', [BookingController::class, 'cancel']);
});

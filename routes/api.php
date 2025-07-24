<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Wishlist\WishlistController;
use Illuminate\Support\Facades\Route;

Route::middleware('jwt.auth')->get('/ping', function () {
    return response()->json(['message' => 'pong'], 200);
});

Route::middleware(['jwt.auth'])->group(function () {
    Route::apiResource('wishlists', WishlistController::class);
});


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::middleware('auth:api')->get('/me', [AuthController::class, 'me']);

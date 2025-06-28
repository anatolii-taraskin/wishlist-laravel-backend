<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


//Route::get('/ping', function () {
//    return response()->json(['message' => 'pong'], 200);
//});

Route::middleware('jwt.auth')->get('/ping', function () {
    return response()->json(['message' => 'pong'], 200);
});





Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::middleware('auth:api')->get('/me', [AuthController::class, 'me']);

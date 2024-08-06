<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);



// Route::get('/profile', [AuthController::class, 'profile'])->middleware('auth:sanctum');

// Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

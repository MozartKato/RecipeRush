<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;

Route::post('/register', [AuthController::class, 'registerUser']);
Route::post('/register/admin', [AuthController::class, 'registerAdmin']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum', 'ability:*'])->group(function () {
    Route::get('/user', [AuthController::class, 'getInfoUser']);
});
<?php

use App\Http\Controllers\RecipeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Controller;

//Unaurhorized route
Route::get('/unauthorized', function () {
    return response()->json(['message' => 'Unauthorized'], 401);
})->name('login');

// Auth routes
Route::post('/register', [AuthController::class, 'registerUser']);
Route::post('/register/admin', [AuthController::class, 'registerAdmin']);
Route::post('/login', [AuthController::class, 'login']);

//public routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', [UserController::class, 'getInfoUser']);
    Route::put('/user', [UserController::class, 'updateUser']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Recipe routes
    Route::get('/recipes', [RecipeController::class, 'getAllPublishedRecipes']);
    Route::post('/recipes', [RecipeController::class, 'createRecipe']);
});

// Admin routes
Route::middleware(['auth:sanctum', 'ability:admin'])->group(function (){
    Route::get('/admin/recipes', [RecipeController::class, 'getAllRecipes']);
    Route::put('/admin/update', [RecipeController::class, 'updateStatus']);
});
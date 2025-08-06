<?php

use App\Http\Controllers\AuthController;    
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('products', App\Http\Controllers\ProductController::class);

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
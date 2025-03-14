<?php

use App\Http\Controllers\ChocolateController;
use App\Http\Controllers\orderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/chocolate',[ChocolateController::class, 'store']);
Route::get('/chocolate',[ChocolateController::class, 'index']);

Route::post('/orders',[orderController::class, 'store']);
Route::get('/orders',[orderController::class, 'index']);

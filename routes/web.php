<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Inventory\ProductController;
use App\Http\Controllers\Inventory\RecipeController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('inventory')->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('recipes', RecipeController::class);
});

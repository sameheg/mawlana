<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\LoyaltyPointController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/customers/register', [CustomerController::class, 'create']);
Route::post('/customers/register', [CustomerController::class, 'store']);

Route::get('/coupons/issue', [CouponController::class, 'create']);
Route::post('/coupons/issue', [CouponController::class, 'store']);

Route::get('/loyalty/add', [LoyaltyPointController::class, 'create']);
Route::post('/loyalty/add', [LoyaltyPointController::class, 'store']);

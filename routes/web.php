<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\LoyaltyPointController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ShiftScheduleController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\TwoFactorController;

use App\Http\Controllers\Inventory\ProductController;
use App\Http\Controllers\Inventory\RecipeController;
use App\Http\Controllers\Procurement\PurchaseOrderController;
use App\Http\Controllers\Procurement\SupplierController;
use App\Http\Controllers\Procurement\TransferController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/customers/register', [CustomerController::class, 'create']);
Route::post('/customers/register', [CustomerController::class, 'store']);

Route::get('/coupons/issue', [CouponController::class, 'create']);
Route::post('/coupons/issue', [CouponController::class, 'store']);

Route::get('/loyalty/add', [LoyaltyPointController::class, 'create']);
Route::post('/loyalty/add', [LoyaltyPointController::class, 'store']);
Route::get('/employees/create', [EmployeeController::class, 'create']);
Route::post('/employees', [EmployeeController::class, 'store']);
Route::get('/employees/{employee}/salary', [EmployeeController::class, 'salary']);

Route::get('/schedules/create', [ShiftScheduleController::class, 'create']);
Route::post('/schedules', [ShiftScheduleController::class, 'store']);

Route::get('/attendance', [AttendanceController::class, 'create']);
Route::post('/attendance', [AttendanceController::class, 'store']);
Route::post('/attendance/clock-out', [AttendanceController::class, 'clockOut']);
Route::view('/kds', 'kds');
Route::prefix('inventory')->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('recipes', RecipeController::class);
});
Route::prefix('procurement')->group(function () {
    Route::resource('suppliers', SupplierController::class);
    Route::resource('purchase-orders', PurchaseOrderController::class);
    Route::get('transfers', [TransferController::class, 'index']);
    Route::post('transfers', [TransferController::class, 'store']);
    Route::post('transfers/{stockTransfer}/approve', [TransferController::class, 'approve']);
    Route::post('transfers/{stockTransfer}/deliver', [TransferController::class, 'deliver']);

Route::middleware('auth')->prefix('two-factor')->group(function () {
    Route::post('enable', [TwoFactorController::class, 'enable']);
    Route::post('verify', [TwoFactorController::class, 'verify']);
});

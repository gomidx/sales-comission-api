<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------a
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/token', [AuthController::class, 'generateToken'])->name('auth.generateToken');
Route::post('/user', [UserController::class, 'store'])->name('user.store');
Route::get('/seller/list/email', [EmailController::class, 'sellersSalesEmail'])->name('seller.sellersListEmail');

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('/sale')->group(function () {
        Route::get('/list', [SaleController::class, 'list'])->name('sale.email');
        Route::get('/list/email', [EmailController::class, 'allSalesEmail'])->name('sale.email');
    });

    Route::prefix('/seller')->group(function () {
        Route::get('/list', [SellerController::class, 'list'])->name('seller.list');
        Route::get('/{id}/sales', [SaleController::class, 'listBySellerId'])->name('seller.salesBySellerId');
        Route::get('/{id}/email', [EmailController::class, 'sellerSalesEmail'])->name('seller.sellerSalesEmail');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::apiResource('user', UserController::class)->except('store');
    Route::apiResource('sale', SaleController::class);
    Route::apiResource('seller', SellerController::class);
});

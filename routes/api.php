<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/token', [AuthController::class, 'generateToken']);
Route::post('/user', [UserController::class, 'store']);

Route::middleware('auth:sanctum')->group(function () {
    // User (Administrador)
    Route::get('user/{id}', [UserController::class, 'get']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Seller
    Route::post('seller', [SellerController::class, 'store']);
    Route::get('seller/list', [SellerController::class, 'list']);
    Route::get('seller/{id}/sales', [SaleController::class, 'listBySellerId']);
    Route::get('seller/{id}', [SellerController::class, 'get']);
    Route::put('seller/{id}', [SellerController::class, 'update']);
    Route::delete('seller/{id}', [SellerController::class, 'delete']);

    // Sale
    Route::post('sale', [SaleController::class, 'store']);
    Route::get('sale/list', [SaleController::class, 'list']);
    Route::get('sale/{id}', [SaleController::class, 'get']);
    Route::delete('sale/{id}', [SaleController::class, 'delete']);
});

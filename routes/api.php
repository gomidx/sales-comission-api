<?php

use App\Http\Controllers\AuthController;
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
    Route::get('/user/list', [UserController::class, 'list']);
    Route::get('/user/{id}', [UserController::class, 'get']);
    Route::put('/user/{id}', [UserController::class, 'update']);
    Route::delete('/user/{id}', [UserController::class, 'delete']);

    // Seller
    Route::post('seller', [SellerController::class, 'store']);
    Route::get('seller/{id}', [SellerController::class, 'get']);
    Route::get('seller/list', [SellerController::class, 'list']);
    Route::put('seller/{id}', [SellerController::class, 'update']);
    Route::delete('seller/{id}', [SellerController::class, 'delete']);
});

<?php

use Illuminate\Http\Request;
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

Route::post('seller', [SellerController::class, 'create']);
Route::get('seller/{id}', [SellerController::class, 'get']);
Route::get('seller/list', [SellerController::class, 'list']);
Route::put('seller/{id}', [SellerController::class, 'update']);
Route::delete('seller/{id}', [SellerController::class, 'delete']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();


});

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('merchant')->group(function (){
   Route::post('add-key',[\App\Http\Controllers\MerchantKey\MerchantKeyController::class,'addKey']);
});

Route::prefix('inventories')->group(function (){
   Route::get('/',[\App\Http\Controllers\Inventories\InventoryController::class,'getInventory']);
   Route::post('/add',[\App\Http\Controllers\Inventories\InventoryController::class,'addInventory']);
});

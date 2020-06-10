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

Route::middleware(['auth:api'])->group(function () {
   Route::resource('stores', 'StoreController');
   Route::resource('measurements', 'MeasurementController');
   Route::resource('inventory-categories', 'CategoryController');
   Route::resource('inventory-items', 'ItemController');
   Route::post('srv-purchase', 'InvoiceController@srvPurchase');
   Route::post('srv-return', 'InvoiceController@srvReturn');
});

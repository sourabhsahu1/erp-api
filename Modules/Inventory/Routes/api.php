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
    Route::post('sale-inwards', 'InvoiceController@salesInwards');
    Route::post('sale-outwards', 'InvoiceController@salesOutwards');
    Route::post('store-inwards', 'InvoiceController@storeInwards');
    Route::post('store-outwards', 'InvoiceController@storeOutwards');
    Route::post('srv-donation', 'InvoiceController@srvDonation');
    Route::post('store-adjustment', 'InvoiceController@storeAdjustment');
    Route::post('store-transfer', 'InvoiceController@storeTransfer');
    Route::get('inventory-ledger-report', 'InvoiceController@inventoryLedgerReport');
    Route::get('inventory-quality-balance', 'InvoiceController@inventoryQualityBalance');
    Route::get('bin-card/report','InvoiceController@binCardReport');
    Route::get('off-level-report', 'InvoiceController@offLevelReport');
    Route::get('company-config', 'ConstantApiController@getConfig');
});

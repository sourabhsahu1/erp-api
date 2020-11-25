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

Route::middleware('auth:api')->get('/treasury', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:api'])->prefix('treasury')->group(function () {
    Route::resource('default-settings', 'DefaultSettingController');
    Route::resource('cashbooks', 'CashbookController');
    Route::resource('aies', 'AieController');
    Route::resource('source-units', 'VoucherSourceUnitController');
    Route::get('cashbook-types', 'CashbookController@getCashbookTypes');

    Route::post('payment-vouchers', 'PaymentVoucherController@store');
    Route::get('payment-vouchers', 'PaymentVoucherController@index');
    Route::post('payment-vouchers/update-status', 'PaymentVoucherController@updateStatus');

    Route::resource('payment-voucher/{payment_voucher_id}/payees-voucher','PayeeVoucherController');
    Route::resource('payee-voucher/{payee_voucher_id}/schedule-voucher','PayeeVoucherController');

});

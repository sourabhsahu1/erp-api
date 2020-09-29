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

    Route::resource('banks', 'BankController');
    Route::resource('bank/{bankId}/branches', 'BankBranchesController');
    Route::resource('journal-vouchers','JournalVoucherController');
    Route::resource('currencies','CurrencyController');

    Route::put('journal-vouchers/{id}/details/{detailId}','JournalVoucherDetailController@update');
    Route::delete('journal-vouchers/{id}/details/{detailId}','JournalVoucherDetailController@destroy');
    Route::get('journal-vouchers/{id}/details/{detailId}','JournalVoucherDetailController@show');

    Route::post('journal-vouchers/update','JournalVoucherController@updateStatus');
});

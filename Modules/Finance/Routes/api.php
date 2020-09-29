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
    Route::get('journal-vouchers','JournalVoucherController@index');
    Route::post('journal-vouchers','JournalVoucherController@store');
    Route::post('journal-vouchers/update','JournalVoucherController@updateStatus');
    Route::put('journal-vouchers/{id}','JournalVoucherController@update');
});

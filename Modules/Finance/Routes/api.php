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
    Route::get('economic-budget','BudgetController@getEconomicBudget');
    Route::get('programme-budget','BudgetController@index');
    Route::post('budget','BudgetController@store');
    Route::put('budget/{id}','BudgetController@update');
    Route::delete('budget/{id}','BudgetController@destroy');

    Route::post('journal-vouchers/{id}/details','JournalVoucherDetailController@store');
    Route::put('journal-vouchers/{id}/details/{detailId}','JournalVoucherDetailController@update');
    Route::delete('journal-vouchers/{id}/details/{detailId}','JournalVoucherDetailController@destroy');
    Route::get('journal-vouchers/{id}/details/{detailId}','JournalVoucherDetailController@show');
    Route::post('journal-vouchers/update','JournalVoucherController@updateStatus');

    //finance report
    //Route::get('finance/trial-report','ReportController@getTrialBalanceReport');



});
    Route::get('finance/trial-report','ReportController@getTrialBalanceReport');
    Route::get('finance/notes-trial-report','ReportController@getNotesTrialBalanceReport');
    Route::get('finance/jv-ledger','ReportController@getJvLedgerReport');
    Route::post('notes/{economicSegmentId}','ReportController@addNotes');

    Route::get('finance/jv-sibling','ReportController@getSiblingReport');

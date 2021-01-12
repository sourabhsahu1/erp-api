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
    Route::resource('payment-vouchers/{payment_voucher_id}/schedule-payees','PayeeVoucherController');
    Route::resource('payee-vouchers/{payee_voucher_id}/schedule-economic','ScheduleEconomicsController');
    Route::get('payment-vouchers/{payment_voucher_id}/schedule-economic','ScheduleEconomicsController@getPaymentVoucherScheduleEconomic');
    Route::get('source-units/{id}/types','PaymentVoucherController@typePaymentVoucher');
    Route::get('payment-voucher-status', 'PaymentVoucherController@statusPaymentVoucher');
    Route::get('retire-voucher-status', 'RetireVoucherController@statusRetireVoucher');



    //Rvs
    Route::get('source-units/{id}/rv-types','ReceiptVoucherController@typePaymentVoucher');
    Route::post('receipt-vouchers', 'ReceiptVoucherController@store');
    Route::get('receipt-vouchers', 'ReceiptVoucherController@index');
    Route::post('receipt-vouchers/update-status', 'ReceiptVoucherController@updateStatus');
    Route::resource('receipt-vouchers/{receipt_voucher_id}/schedule-payees','ReceiptPayeeController');
    Route::resource('receipt-payees/{receipt_payee_id}/schedule-economic','ReceiptScheduleEconomicController');
    Route::get('receipt-vouchers/{receipt_voucher_id}/schedule-economic','ReceiptScheduleEconomicController@getReceiptVoucherScheduleEconomic');
    Route::get('receipt-voucher-status', 'ReceiptVoucherController@statusReceiptVoucher');

    //report
    Route::get('report/summary-non-personal','ReportController@summaryNonPersonalAdvances');
    Route::get('report/summary-personal','ReportController@summaryPersonalAdvances');
    Route::get('report/summary-special','ReportController@summarySpecialImprest');
    Route::get('report/summary-standing','ReportController@summaryStandingImprest');
    Route::get('report/advance-ledger','ReportController@advanceLedger');

    Route::get('download/payment-vouchers','ReportController@downloadReportPv');
    Route::get('download/receipt-vouchers','ReportController@downloadReportRv');

    //Mandate
    Route::get('mandate','MandateController@index');
    Route::post('mandate','MandateController@store');
    Route::put('mandate/{id}','MandateController@update');
    Route::post('mandate-update','MandateController@mandateUpdate');

    Route::get('retire-voucher','RetireVoucherController@index');
    Route::post('retire-voucher','RetireVoucherController@store');
    Route::put('retire-voucher/{id}','RetireVoucherController@update');
});

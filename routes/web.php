<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Modules\Treasury\Models\PayeeVoucher;

Route::get('/chromeshot', function () {
    \App\Services\WKHTMLPDfConverter::convertChromeShot(view('welcome')->render(), 'asdf.pdf');
    dd(url('pdf/asdf.pdf'));
    return view('welcome');
});

Route::get('/seed', function () {
    /** @var PayeeVoucher $payeeVs */
    $payeeVs = \Modules\Treasury\Models\PayeeVoucher::get();
    foreach ($payeeVs as $payeeV){
        $taxes = json_decode($payeeV->tax_ids,true);
        if ($taxes === null){
            continue;
        }
        if (count($taxes) <= 0){
           continue;
       }
        foreach ($taxes as $tax){

            $tax = \Modules\Admin\Models\Tax::find($tax);
            if ($tax){
                \Modules\Treasury\Models\PayeeVoucherCustomTax::create([
                    'payee_voucher_id' => $payeeV->id,
                    'tax_id' => $tax->id,
                    'tax_percentage' => $tax->tax
                ]);
            }

        }

    }

    dd("done");
});
Route::get('/seed2', function () {
    /** @var PayeeVoucher $payeeVs */
    $payeeVs = \Modules\Treasury\Models\PaymentApprovalPayee::get();
    foreach ($payeeVs as $payeeV){
        $taxes = json_decode($payeeV->tax_ids,true);
        if ($taxes === null){
            continue;
        }
        if (count($taxes) <= 0){
           continue;
       }
        foreach ($taxes as $tax){

            $tax = \Modules\Admin\Models\Tax::find($tax);
            if ($tax){
                \Modules\Treasury\Models\PayeeApprovalCustomTax::create([
                    'payment_approval_payee_id' => $payeeV->id,
                    'tax_id' => $tax->id,
                    'tax_percentage' => $tax->tax
                ]);
            }

        }

    }

    dd("done");
});

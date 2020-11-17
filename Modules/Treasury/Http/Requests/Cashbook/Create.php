<?php


namespace Modules\Treasury\Http\Requests\Cashbook;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{

    public function rules()
    {
        return [
            'economicSegmentId' => 'required',
            'cashbookTitle' => 'required',
            'bankStatement' => 'required',
            'cashbook' => 'required',
            'xRateLocalCurrency' => 'required',
            'paymentVoucherId' => 'sometimes',
            'receiptVoucherId' => 'sometimes',
            'eMandate' => 'sometimes',
            'prefix' => 'sometimes',
            'suffix' => 'sometimes',
            'fundOwnedBy' => 'required',
            'bankAccountNumber' => 'required',
            'bankId' => 'required',
            'bankBranchId' => 'required',
            'title' => 'required',
            'currencyId' => 'required',
            'bankEMandate' => 'required'
        ];
    }
}

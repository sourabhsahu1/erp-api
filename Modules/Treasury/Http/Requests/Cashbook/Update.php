<?php


namespace Modules\Treasury\Http\Requests\Cashbook;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Update  extends BaseRequest
{

    public function rules()
    {
        return [
            'economicSegmentId' => 'sometimes',
            'cashbookTitle' => 'sometimes',
            'bankStatement' => 'sometimes',
            'cashbook' => 'sometimes',
            'xRateLocalCurrency' => 'sometimes',
            'paymentVoucherId' => 'sometimes',
            'receiptVoucherId' => 'sometimes',
            'eMandate' => 'sometimes',
            'prefix' => 'sometimes',
            'suffix' => 'sometimes',
            'fundOwnedBy' => 'sometimes',
            'bankAccountNumber' => 'sometimes',
            'bankId' => 'sometimes',
            'bankBranchId' => 'sometimes',
            'title' => 'sometimes',
            'currencyId' => 'sometimes',
            'typeOfAccount' => 'sometimes'
        ];
    }
}

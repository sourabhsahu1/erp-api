<?php


namespace Modules\Treasury\Http\Requests\VoucherSourceUnit;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Update extends BaseRequest
{

    public function rules()
    {
        return [
            'longName' => 'sometimes',
            'shortName' => 'sometimes',
            'nextPvIndexNumber' => 'sometimes',
            'nextRvIndexNumber' => 'sometimes',
            'honourCertificate' => 'sometimes',
            'checkingOfficerId' => 'sometimes',
            'payingOfficerId' => 'sometimes',
            'financialControllerId' => 'sometimes',
            'retirementId' => 'sometimes|exists:treasury_voucher_source_units,id',
            'reverseVoucherId' => 'sometimes|exists:treasury_voucher_source_units,id',
            'revalidationId' => 'sometimes|exists:treasury_voucher_source_units,id',
            'taxVoucherId' => 'sometimes|exists:treasury_voucher_source_units,id'
        ];
    }
}

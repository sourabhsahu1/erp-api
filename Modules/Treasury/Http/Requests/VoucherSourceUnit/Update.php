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
            'retirementId' => 'sometimes',
            'reverseVoucherId' => 'sometimes',
            'revalidationId' => 'sometimes',
            'taxVoucherId' => 'sometimes'
        ];
    }
}

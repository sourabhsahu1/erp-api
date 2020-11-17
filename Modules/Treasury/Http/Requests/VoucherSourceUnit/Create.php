<?php


namespace Modules\Treasury\Http\Requests\VoucherSourceUnit;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{

    public function rules()
    {
        return [
            'longName' => 'required',
            'shortName' => 'required',
            'nextPvIndexNumber' => 'required',
            'nextRvIndexNumber' => 'required',
            'honourCertificate' => 'required',
            'checkingOfficerId' => 'required',
            'payingOfficerId' => 'required',
            'financialControllerId' => 'required',
            'retirementId' => 'required',
            'reverseVoucherId' => 'required',
            'revalidationId' => 'required',
            'taxVoucherId' => 'required'
        ];
    }
}

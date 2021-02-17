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
            'retirementId' => 'required|exists:treasury_voucher_source_units,id',
            'reverseVoucherId' => 'required|exists:treasury_voucher_source_units,id',
            'revalidationId' => 'required|exists:treasury_voucher_source_units,id',
            'taxVoucherId' => 'required|exists:treasury_voucher_source_units,id'
        ];
    }
}

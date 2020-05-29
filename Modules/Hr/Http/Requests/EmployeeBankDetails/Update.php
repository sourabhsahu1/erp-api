<?php


namespace Modules\Hr\Http\Requests\EmployeeBankDetails;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Update extends BaseRequest
{
    public function rules()
    {
        return [
            'bankId' => "sometimes|exists:hr_banks,id",
            'bankBranchId' => "sometimes,hr_bank_branches,id",
            'title' => "sometimes",
            'number' => "sometimes",
            'type' => "sometimes"
        ];
    }
}

<?php


namespace Modules\Hr\Http\Requests\EmployeeBankDetails;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{
    public function rules()
    {
        return [
            'bankId' => "required|exists:hr_banks,id",
            'bankBranchId' => "required,hr_bank_branches,id",
            'title' => "required",
            'number' => "required",
            'type' => "required"
        ];
    }

}

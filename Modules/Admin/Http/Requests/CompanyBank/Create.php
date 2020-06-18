<?php


namespace Modules\Admin\Http\Requests\CompanyBank;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{

    public function rules()
    {
        return [
            "companyId"=> "required|exists:admin_companies,id",
            "bankId"=> "required|exists:hr_banks,id",
            "branchId"=> "required|exists:hr_bank_branches,id",
            "bankAccountNumber"=> "required",
            "typeOfBankAccount"=> "required",
            "isAuthorised"=> "required|boolean"
//            "date"=> "required|date"
        ];
    }
}

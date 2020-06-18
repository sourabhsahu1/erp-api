<?php


namespace Modules\Admin\Http\Requests\CompanyBank;

use Luezoid\Laravelcore\Requests\BaseRequest;

class Update extends BaseRequest
{
    public function rules()
    {
        return [
            "companyId"=> "sometimes|exists:admin_companies,id",
            "bankId"=> "sometimes|exists:hr_banks,id",
            "branchId"=> "sometimes|exists:hr_bank_branches,id",
            "bankAccountNumber"=> "sometimes",
            "typeOfBankAccount"=> "sometimes",
            "isAuthorised"=> "sometimes|boolean"
//            "date"=> "sometimes|date"
        ];
    }

}

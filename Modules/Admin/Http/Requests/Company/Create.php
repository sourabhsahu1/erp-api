<?php


namespace Modules\Admin\Http\Requests\Company;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{

    public function rules()
    {
        return [
            "name"=> "required",
            "isCustomer"=> "required|boolean",
            "isSupplier"=> "required|boolean",
            "isActive"=> "required|boolean",
            "isCashbookAc"=> "required|boolean",
            "isOnOff"=> "required|boolean",
            "isPfa"=> "required|boolean",
            "city"=> "required",
            "state"=> "required",
            "country"=> "required",
            "address"=> "required",
            "phone"=> "required|digits:10",
            "email"=> "required|email|unique:admin_companies",
            "website"=> "required"
        ];
    }
}

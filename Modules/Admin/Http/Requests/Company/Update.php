<?php


namespace Modules\Admin\Http\Requests\Company;


use Illuminate\Validation\Rule;
use Luezoid\Laravelcore\Requests\BaseRequest;

class Update extends BaseRequest
{
    public function rules()
    {
        return [
            "name" => "sometimes",
            "isCustomer" => "sometimes|boolean",
            "isSupplier" => "sometimes|boolean",
            "isActive" => "sometimes|boolean",
            "isCashbookAc" => "sometimes|boolean",
            "isOnOff" => "sometimes|boolean",
            "isPf" => "sometimes|boolean",
            "city" => "sometimes",
            "state" => "sometimes",
            "country" => "sometimes",
            "address" => "sometimes",
            "phone" => "sometimes|digits:10",
            "email" => [
                'sometimes',
                'email',
                Rule::unique('companies')->ignore($this->route('company'))
            ],
            "website" => "sometimes"
        ];
    }

}

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
            "isPfa" => "sometimes|boolean",
            "city" => "sometimes",
            "state" => "sometimes",
            "country" => "sometimes",
            "address" => "sometimes",
            'phone' => 'sometimes|regex:/^([0-9\s\-\+\(\)]*)$/|min:7|max:15',
            "email" => [
                'sometimes',
                'email',
                Rule::unique('admin_companies')->ignore($this->route('company'))
            ],
            "website" => "sometimes"
        ];
    }

}

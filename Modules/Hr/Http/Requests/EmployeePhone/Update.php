<?php


namespace Modules\Hr\Http\Requests\EmployeePhone;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Update extends BaseRequest
{
    public function rules()
    {
        return [
            'phoneNumberTypeId' => "sometimes|exists:hr_phone_number_types,id",
            'phone' => "sometimes|regex:/^([0-9\s\-\+\(\)]*)$/|min:7|max:15",
            'extension' => "sometimes|min:2|max:5"
        ];
    }

}

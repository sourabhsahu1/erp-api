<?php


namespace Modules\Hr\Http\Requests\EmployeePhone;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{
    public function rules()
    {
        return [
            'phoneNumberTypeId' => "required|exists:hr_phone_number_types,id",
            'phone' => "required|regex:/^([0-9\s\-\+\(\)]*)$/|min:7|max:15",
            'extension' => "required|min:2|max:5"
        ];
    }

}

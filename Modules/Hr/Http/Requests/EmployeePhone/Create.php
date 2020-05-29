<?php


namespace Modules\Hr\Http\Requests\EmployeePhone;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{
    public function rules()
    {
        return [
            'phoneNumberTypeId' => "required|exists:hr_phone_number_types,id",
            'phone' => "required|digits:10",
            'extension' => "required"
        ];
    }

}

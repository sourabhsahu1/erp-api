<?php


namespace Modules\Hr\Http\Requests\EmployeePhone;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Update extends BaseRequest
{
    public function rules()
    {
        return [
            'phoneNumberTypeId' => "sometimes|exists:hr_phone_number_types,id",
            'phone' => "sometimes|digits:10",
            'extension' => "sometimes"
        ];
    }

}

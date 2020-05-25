<?php


namespace Modules\Hr\Http\Requests\Employee;


use Illuminate\Validation\Rule;
use Luezoid\Laravelcore\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{

    function rules()
    {
        return [
            'personnelFileNumber' => 'sometimes',
            'lastName' => 'sometimes',
            'firstName' => 'sometimes',
            'otherName' => 'sometimes',
            'title' => 'sometimes',
            'profileImageId' => "sometimes",
            'maidenName' => "sometimes"
//            "name" => ["required", Rule::unique("employees", 'name')->ignore($this->route('id'))]
        ];
    }
}

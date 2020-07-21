<?php


namespace Modules\Hr\Http\Requests\Employee;


use Illuminate\Validation\Rule;
use Luezoid\Laravelcore\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{

    function rules()
    {
        $id = $this->route('id');
        return [
            'personnelFileNumber' => ['sometimes',Rule::unique('hr_employees','personnel_file_number')->ignore($id)],
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

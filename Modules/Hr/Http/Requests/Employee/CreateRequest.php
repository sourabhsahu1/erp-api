<?php


namespace Modules\Hr\Http\Requests\Employee;


use Illuminate\Validation\Rule;
use Luezoid\Laravelcore\Requests\BaseRequest;

class CreateRequest extends BaseRequest
{

    function rules()
    {
        return [
            'personnelFileNumber' => 'required|unique:hr_employees,personnel_file_number',
            'lastName' => 'required',
            'firstName' => 'required',
            'otherName' => 'sometimes',
            'title' => 'sometimes',
            'profileImageId' => "sometimes",
            'maidenName' => "sometimes"
        ];
    }
}

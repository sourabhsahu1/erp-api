<?php


namespace Modules\Hr\Http\Requests\Employee;


use Illuminate\Validation\Rule;
use Luezoid\Laravelcore\Requests\BaseRequest;

class CreateRequest extends BaseRequest
{

    function rules()
    {
        return [
            'personnel_file_number' => 'required',
            'last_name' => 'required',
            'first_name' => 'required',
            'other_name' => 'sometimes',
            'title' => 'sometimes',
            'profile_image_id' => "sometimes",
            'maiden_name' => "sometimes"
        ];
    }
}

<?php


namespace Modules\Hr\Http\Requests\Employee;


use Illuminate\Validation\Rule;
use Luezoid\Laravelcore\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{

    function rules()
    {
        return [
            "name" => ["required", Rule::unique("employees", 'name')->ignore($this->route('id'))]
        ];
    }
}

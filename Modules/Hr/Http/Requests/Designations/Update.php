<?php


namespace Modules\Hr\Http\Requests\Designations;


use Illuminate\Validation\Rule;
use Luezoid\Laravelcore\Requests\BaseRequest;

class Update extends BaseRequest
{
    public function rules()
    {
        $id = $this->route('designation');
        return [
            "name" => ["required", Rule::unique('hr_designations')->ignore($id)],
            "isActive" => "required|boolean"
        ];
    }

}
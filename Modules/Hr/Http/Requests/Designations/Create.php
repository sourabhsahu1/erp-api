<?php


namespace Modules\Hr\Http\Requests\Designations;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{
    public function rules()
    {
        return [
            "name" => "required|unique:hr_designations",
            "isActive" => "required|boolean"
        ];
    }

}
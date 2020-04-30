<?php


namespace Modules\Hr\Http\Requests\Departments;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{
    public function rules()
    {
        return [
            "name" => "required",
            "isActive" => "required|boolean"
        ];
    }

}
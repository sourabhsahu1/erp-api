<?php


namespace Modules\Hr\Http\Requests\Skills;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{
    public function rules()
    {
        return [
            "name" => "required|unique:hr_skills",
            "isActive" => "required|boolean"
        ];
    }

}
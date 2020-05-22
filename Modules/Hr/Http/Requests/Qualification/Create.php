<?php


namespace Modules\Hr\Http\Requests\Qualification;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{
    public function rules()
    {
        return [
            "name" => "required|unique:hr_qualifications",
            "isActive" => "required|boolean"
        ];
    }

}
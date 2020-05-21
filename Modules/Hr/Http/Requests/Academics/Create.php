<?php


namespace Modules\Hr\Http\Requests\Academics;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{
    public function rules()
    {
        return [
            "name" => "required|unique:hr_academics",
            "isActive" => "required|boolean"
        ];
    }

}
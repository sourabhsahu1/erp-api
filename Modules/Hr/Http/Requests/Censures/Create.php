<?php


namespace Modules\Hr\Http\Requests\Censures;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{
    public function rules()
    {
        return [
            "name" => "required|unique:hr_censures",
            "isActive" => "required|boolean"
        ];
    }

}
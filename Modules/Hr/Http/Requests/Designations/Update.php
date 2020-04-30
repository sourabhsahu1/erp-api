<?php


namespace Modules\Hr\Http\Requests\Designations;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Update extends BaseRequest
{
    public function rules()
    {
        return [
            "name" => "required",
            "isActive" => "required|boolean"
        ];
    }

}
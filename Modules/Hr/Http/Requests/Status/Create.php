<?php


namespace Modules\Hr\Http\Requests\Status;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{
    public function rules()
    {
        return [
            "name" => "required|unique:hr_status",
            "isActive" => "required|boolean"
        ];
    }

}
<?php


namespace Modules\Hr\Http\Requests\Disengagement;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{
    public function rules()
    {
        return [
            "name" => "required|unique:hr_disengagements",
            "isActive" => "required|boolean"
        ];
    }

}
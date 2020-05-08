<?php


namespace Modules\Hr\Http\Requests\LeaveGroup;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{

    public function rules()
    {
        return [
            "name" => "required"
        ];
    }

}
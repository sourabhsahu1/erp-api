<?php


namespace Modules\Hr\Http\Requests\LeaveGroup;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Update extends BaseRequest
{

    public function rules()
    {
        return [
            "name" => "required"
        ];
    }
}

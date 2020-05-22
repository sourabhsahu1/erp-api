<?php


namespace Modules\Hr\Http\Requests\Membership;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{
    public function rules()
    {

        return [
            "name" => "required|unique:hr_memberships",
            "isActive" => "required|boolean"
        ];
    }

}
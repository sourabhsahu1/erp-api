<?php


namespace Modules\Hr\Http\Requests\EmployeeBackGround;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Update extends BaseRequest
{
    public function rules()
    {
        return [
            "details" => "required"
        ];
    }

}

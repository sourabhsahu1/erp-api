<?php


namespace Modules\Hr\Http\Requests\Schedule;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{
    public function rules()
    {
        return [
            "name" => "required|unique:hr_schedules",
            "isActive" => "required|boolean"
        ];
    }

}
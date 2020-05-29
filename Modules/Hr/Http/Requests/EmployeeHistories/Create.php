<?php


namespace Modules\Hr\Http\Requests\EmployeeHistories;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{
    public function rules()
    {
        return [
            'employer' => "required",
            'engaged'=> "required",
            'disengaged'=> "required",
            'totalRemuneration'=> "required",
            'filePage'=> "required"
        ];
    }

}

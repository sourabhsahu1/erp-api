<?php


namespace Modules\Hr\Http\Requests\EmployeeHistories;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Update extends BaseRequest
{
    public function rules()
    {
        return [
            'employer' => "sometimes",
            'engaged'=> "sometimes",
            'disengaged'=> "sometimes",
            'totalRemuneration'=> "sometimes",
            'filePage'=> "sometimes"
        ];
    }

}

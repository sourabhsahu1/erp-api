<?php


namespace Modules\Hr\Http\Requests\Leaves;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{

    public function rules()
    {
        return [
            'name' => 'required',
            'shortName'=> 'required',
            'isCarryOverUnusedLeave'=> 'required|boolean',
            'isPaidLeave'=> 'required|boolean',
            'isCalenderDays'=> 'required|boolean',
            'isActive'=> 'required|boolean',
            'autoCreate'=> 'required|boolean'
        ];
    }
}
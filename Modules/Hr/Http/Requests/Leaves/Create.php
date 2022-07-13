<?php


namespace Modules\Hr\Http\Requests\Leaves;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{

    public function rules()
    {

        return [
            'title' => 'required|unique:hr_leaves',
            'shortName'=> 'required',
            'isPaidLeave'=> 'required|boolean',
            'isCalenderDays'=> 'required|boolean',
            'entitledAnnually'=> 'required|boolean',
            'rollOverUnusedLeave'=> 'required|boolean',
            'isActive'=> 'required|boolean',
        ];
    }
}
<?php


namespace Modules\Hr\Http\Requests\Leaves;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{

    public function rules()
    {
        return [
            'name' => 'required',
            'short_name'=> 'required',
            'is_carry_over_unused_leave'=> 'required|boolean',
            'is_paid_leave'=> 'required|boolean',
            'is_calender_days'=> 'required|boolean',
            'is_active'=> 'required|boolean',
            'auto_create'=> 'required|boolean'
        ];
    }
}
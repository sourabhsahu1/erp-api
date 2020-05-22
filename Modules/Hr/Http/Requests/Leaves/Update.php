<?php


namespace Modules\Hr\Http\Requests\Leaves;


use Illuminate\Validation\Rule;
use Luezoid\Laravelcore\Requests\BaseRequest;

class Update extends BaseRequest
{

    public function rules()
    {

        $id = $this->route('leaf');
        return [
            'name' => ['required', Rule::unique('hr_leaves')->ignore($id)],
            'shortName'=> 'required',
            'isCarryOverUnusedLeave'=> 'required|boolean',
            'isPaidLeave'=> 'required|boolean',
            'isCalenderDays'=> 'required|boolean',
            'isActive'=> 'required|boolean',
            'autoCreate'=> 'required|boolean'
        ];
    }
}
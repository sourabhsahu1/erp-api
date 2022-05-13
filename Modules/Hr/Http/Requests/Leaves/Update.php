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
            'title' => ['required', Rule::unique('hr_leaves')->ignore($id)],
            'shortName'=> 'required',
            'isPaidLeave'=> 'required|boolean',
            'isCalenderDays'=> 'required|boolean',
            'entitledAnnually'=> 'required|boolean',
            'rollOverUnusedLeave'=> 'required|boolean',
            'isActive'=> 'required|boolean',
        ];
    }
}
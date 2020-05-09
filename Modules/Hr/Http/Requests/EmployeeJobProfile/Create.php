<?php


namespace Modules\Hr\Http\Requests\EmployeeJobProfile;


use Illuminate\Validation\Rule;
use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{

    public function rules()
    {
        return [
            'jobPositionId' => 'required|exists:hr_job_positions,id',
            'workLocationId' =>'required|exists:hr_work_locations,id',
            'currentAppointment' => 'required|date'
        ];
    }
}
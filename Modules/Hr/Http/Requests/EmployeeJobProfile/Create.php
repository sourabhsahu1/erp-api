<?php


namespace Modules\Hr\Http\Requests\EmployeeJobProfile;


use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Luezoid\Laravelcore\Requests\BaseRequest;
use Modules\Hr\Models\EmployeePersonalDetail;

class Create extends BaseRequest
{

    public function rules()
    {
        return [
            'jobPositionId' => 'required|exists:hr_job_positions,id',
            'workLocationId' =>'required|exists:hr_work_locations,id',
            'currentAppointment' => ["required" ,"date", function($a,$v,$f) {
                $id =$this->route()->parameter('id');
                /** @var EmployeePersonalDetail $employeePersonalDetail */
                $employeePersonalDetail = EmployeePersonalDetail::where('employee_id', $id)->first();
                $v = Carbon::parse($v)->toDateString();

                if ($employeePersonalDetail->assumed_duty_on > $v){
                    return $f('Current Appointment can\'t be earlier than assumed duty date');
                }
                if ($v > Carbon::now()->toDateString()) {
                    return $f('Future date not allowed');
                }
            }],
        ];
    }
}
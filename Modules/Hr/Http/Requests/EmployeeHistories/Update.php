<?php


namespace Modules\Hr\Http\Requests\EmployeeHistories;


use Carbon\Carbon;
use Luezoid\Laravelcore\Requests\BaseRequest;
use Modules\Hr\Models\EmployeePersonalDetail;

class Update extends BaseRequest
{
    public function rules()
    {
        $empId = $this->route('employeeId');
        return [
            'employer' => "required",
            'engaged' => ['required', 'date', function ($a, $v, $f) {
                if (strtotime($this->get('disengaged')) < strtotime($v)) {
                    return $f("engaged date cannot be greater than disengaged date");
                }
            }],
            'disengaged' => ['required', function ($a, $v, $f) use ($empId){
                $empJobProfile =  EmployeePersonalDetail::where('employee_id', $empId)->first();
                if ($empJobProfile->assumed_duty_on < Carbon::parse($v)->toDateString()) {
                    return $f("disengaged date cannot later than assumed duty date date");
                }
            }],
            'totalRemuneration' => "required",
            'filePage' => "required"
        ];
    }

}

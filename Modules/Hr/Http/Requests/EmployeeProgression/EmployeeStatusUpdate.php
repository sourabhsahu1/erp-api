<?php


namespace Modules\Hr\Http\Requests\EmployeeProgression;


use App\Constants\AppConstant;
use Illuminate\Validation\Rule;
use Luezoid\Laravelcore\Requests\BaseRequest;
use Modules\Hr\Models\EmployeeProgression;

class EmployeeStatusUpdate extends BaseRequest
{
    public function rules()
    {
        return [
            'status' => [
                'required',
                Rule::in([
                    AppConstant::PROGRESSION_STATUS_NEW,
                    AppConstant::PROGRESSION_STATUS_ACTIVE,
                    AppConstant::PROGRESSION_STATUS_RETIRE,
                    AppConstant::PROGRESSION_STATUS_CONFIRMED,
                    AppConstant::PROGRESSION_STATUS_PROMOTION,
                    AppConstant::PROGRESSION_STATUS_INCREMENT,
                ])
            ],
            'employeeIds' => 'required|array',
            'employeeIds.*' => ['exists:hr_employees,id', function($a, $v, $f) {
                $status = $this->get('status');
                /** @var EmployeeProgression $emp */
                $emp = EmployeeProgression::where('employee_id', $v)->first();
                if ($status == AppConstant::PROGRESSION_STATUS_CONFIRMED) {
                    if ($emp->status == AppConstant::PROGRESSION_STATUS_NEW) {
                        return $f("employee is not Activated");
                    }
                }
                if ($status == AppConstant::PROGRESSION_STATUS_RETIRE) {
                    if ($emp->status == AppConstant::PROGRESSION_STATUS_NEW) {
                        return $f("employee is not Activated");
                    }
                }
                if ($status == AppConstant::PROGRESSION_STATUS_PROMOTION) {
                    if ($emp->status == AppConstant::PROGRESSION_STATUS_NEW) {
                        return $f("employee is not Activated");
                    }
                }
                if ($status == AppConstant::PROGRESSION_STATUS_INCREMENT) {
                    if ($emp->status == AppConstant::PROGRESSION_STATUS_NEW) {
                        return $f("employee is not Activated");
                    }
                }

                //TODO CONFIRMED VALIDATION
                if ((!is_null($emp->confirmed_date)) && ($status == AppConstant::PROGRESSION_STATUS_ACTIVE)) {
                    return $f("Employee is already confirmed");
                }
                if ((!is_null($emp->confirmed_date)) && ($status == AppConstant::PROGRESSION_STATUS_CONFIRMED)) {
                    return $f("Employee is already confirmed");
                }
                if ((!is_null($emp->confirmed_date)) && ($status == AppConstant::PROGRESSION_STATUS_ACTIVE)) {
                    return $f("Employee is already confirmed");
                }
                if (($emp->status == AppConstant::PROGRESSION_STATUS_ACTIVE) && ($status == AppConstant::PROGRESSION_STATUS_ACTIVE)) {
                    return $f("Employee is already active");
                }
                if (($emp->status == AppConstant::PROGRESSION_STATUS_RETIRE) && ($status == AppConstant::PROGRESSION_STATUS_RETIRE)) {
                    return $f("Employee is already retired");
                }
                if (($emp->status == AppConstant::PROGRESSION_STATUS_RETIRE) && ($status == AppConstant::PROGRESSION_STATUS_ACTIVE)) {
                    return $f("Employee is already retired");
                }
                if (($emp->status == AppConstant::PROGRESSION_STATUS_RETIRE) && ($status == AppConstant::PROGRESSION_STATUS_CONFIRMED)) {
                    return $f("Employee is already retired");
                }
                if (($emp->status == AppConstant::PROGRESSION_STATUS_RETIRE) && ($status == AppConstant::PROGRESSION_STATUS_INCREMENT)) {
                    return $f("Employee is already retired");
                }
                if (($emp->status == AppConstant::PROGRESSION_STATUS_RETIRE) && ($status == AppConstant::PROGRESSION_STATUS_PROMOTION)) {
                    return $f("Employee is already retired");
                }

            }]
        ];
    }

}
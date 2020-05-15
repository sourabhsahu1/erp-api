<?php


namespace Modules\Hr\Http\Requests\EmployeeProgression;


use App\Constants\AppConstant;
use Illuminate\Validation\Rule;
use Luezoid\Laravelcore\Requests\BaseRequest;

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
                    AppConstant::PROGRESSION_STATUS_PROMOTION,
                    AppConstant::PROGRESSION_STATUS_INCREMENT,
                ])
            ],
            'employeeIds' => 'required|array',
            'employeeIds.*' => 'exists:hr_employees,id'
        ];
    }

}
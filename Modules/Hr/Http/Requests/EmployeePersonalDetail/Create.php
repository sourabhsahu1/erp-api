<?php


namespace Modules\Hr\Http\Requests\EmployeePersonalDetail;


use App\Constants\AppConstant;
use Illuminate\Validation\Rule;
use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{

    public function rules()
    {
        return [
            'dateOfBirth' => "date",
            'maritalStatus' => [
                "required",
                Rule::in([
                    AppConstant::EMPLOYEE_MARITAL_STATUS_WIDOWED,
                    AppConstant::EMPLOYEE_MARITAL_STATUS_DIVORCED,
                    AppConstant::EMPLOYEE_MARITAL_STATUS_SINGLE,
                    AppConstant::EMPLOYEE_MARITAL_STATUS_MARRIED
                ])
            ],
            'gender' => [
                "required",
                Rule::in([
                    AppConstant::EMPLOYEE_GENDER_FEMALE,
                    AppConstant::EMPLOYEE_GENDER_MALE
                ])
            ],
            'religion' => [
                "required",
                Rule::in([
                    AppConstant::EMPLOYEE_RELIGION_ISLAM,
                    AppConstant::EMPLOYEE_RELIGION_CHRISTIANITY,
                    AppConstant::EMPLOYEE_RELIGION_OTHER
                ])
            ],
            'phone' => "required|digits:10",
            'email' => "required|email",
            'isPermanentStaff' => "required|boolean",
            'typeOfAppointment' => [
                "required",
                Rule::in([
                    AppConstant::EMPLOYEE_TYPE_APPOINTMENT_VISITING,
                    AppConstant::EMPLOYEE_TYPE_APPOINTMENT_TEMPORARY,
                    AppConstant::EMPLOYEE_TYPE_APPOINTMENT_SABBATICAL,
                    AppConstant::EMPLOYEE_TYPE_APPOINTMENT_PERMANENT_STAFF,
                    AppConstant::EMPLOYEE_TYPE_APPOINTMENT_NOT_APPLICABLE,
                    AppConstant::EMPLOYEE_TYPE_APPOINTMENT_MONTH_TO_MONTH,
                    AppConstant::EMPLOYEE_TYPE_APPOINTMENT_FULL_TIME,
                    AppConstant::EMPLOYEE_TYPE_APPOINTMENT_ADJUNCT,
                    AppConstant::EMPLOYEE_TYPE_APPOINTMENT_CONTRACT,
                    AppConstant::EMPLOYEE_TYPE_APPOINTMENT_TENURED,
                ])
            ],
            'appointedOn' => "required|date",
            'assumedDutyOn' => "required|date"
        ];
    }
}
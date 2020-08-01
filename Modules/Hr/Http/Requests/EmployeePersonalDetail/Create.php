<?php


namespace Modules\Hr\Http\Requests\EmployeePersonalDetail;


use App\Constants\AppConstant;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Luezoid\Laravelcore\Requests\BaseRequest;
use Modules\Hr\Models\EmployeePersonalDetail;

class Create extends BaseRequest
{

    public function rules()
    {

        $empId = $this->route('id');
        $id = EmployeePersonalDetail::where('employee_id', $empId)->first();

        return [
            'dateOfBirth' => ["required","date", function($a,$v, $f) {
                $dOB = Carbon::parse($v)->toDateString();
                if ($dOB > Carbon::now()->toDateString()) {
                    return $f('Date of birth cannot lies in Future');
                }
            }],
            'maritalStatus' => [
                "required",
                Rule::in([
                    AppConstant::EMPLOYEE_MARITAL_STATUS_WIDOWED,
                    AppConstant::EMPLOYEE_MARITAL_STATUS_DIVORCED,
                    AppConstant::EMPLOYEE_MARITAL_STATUS_SINGLE,
                    AppConstant::EMPLOYEE_MARITAL_STATUS_MARRIED,
                    AppConstant::EMPLOYEE_MARITAL_STATUS_OTHER
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
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:7|max:15',
            'countryCode' => "required|min:2|max:5",
            'email' => ['required','email',Rule::unique('hr_employee_personal_details')->ignore($id)],
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
            'appointedOn' => ["required", "date", function ($a, $v, $f) {
                $date = Carbon::parse($v)->toDateString();
                if ($date > Carbon::now()->toDateString()) {
                    return $f('Future date not allowed');
                }
            }],
            'assumedDutyOn' => ["required","date", function($a,$v, $f) {
               $appointedOn = Carbon::parse($this->get('appointedOn'))->toDateString();
               $assumedDutyOn = Carbon::parse($v)->toDateString();
               if ($appointedOn > $assumedDutyOn) {
                    return $f('Assumed Duty On date cannot be earlier than Appointed Date');
               }
                if ($assumedDutyOn > Carbon::now()->toDateString()) {
                    return $f('Future date not allowed');
                }
            }]
        ];
    }
}

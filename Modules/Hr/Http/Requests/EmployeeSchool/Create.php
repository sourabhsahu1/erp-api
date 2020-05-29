<?php


namespace Modules\Hr\Http\Requests\EmployeeSchool;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{
    public function rules()
    {
        return [
            'scheduleId' => "required|exists:hr_schedules,id",
            'countryId' => "required|exists:countries,id",
            'school' => "required",
            'address' => "required",
            'enteredAt' => "required|date",
            'exitedAt' => "required|date"
        ];
    }

}

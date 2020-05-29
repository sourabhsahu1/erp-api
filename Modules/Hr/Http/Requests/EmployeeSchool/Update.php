<?php


namespace Modules\Hr\Http\Requests\EmployeeSchool;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Update extends BaseRequest
{
    public function rules()
    {
        return [
            'scheduleId' => "sometimes|exists:hr_schedules,id",
            'countryId' => "sometimes|exists:countries,id",
            'school' => "sometimes",
            'address' => "sometimes",
            'enteredAt' => "sometimes|date",
            'exitedAt' => "sometimes|date"
        ];
    }

}

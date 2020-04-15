<?php


namespace Modules\Hr\Http\Requests\Employee;


use Illuminate\Validation\Rule;
use Luezoid\Laravelcore\Requests\BaseRequest;

class CreateRequest extends BaseRequest
{

    function rules()
    {
        return [

            "firstName" => "required",
            "lastName" => "sometimes",
            "dateOfBirth" => "required|date",
            "maritalStatus" => "required",
            "gender" => "required",
            "religion" => "required",
            "phone" => "required|digits:10",
            "email" => "required|email",
            "isPermanentStaff" => "required|boolean",
            "typeOfAppointment" => "required",
            "appointedOn" => "required|date",
            "assumedDuty" => "required",
            "jobPosition" => "required",
            "adminUnit" => "required",
            "workLocation" => "required",
            "designation" => "required",
        ];
    }
}

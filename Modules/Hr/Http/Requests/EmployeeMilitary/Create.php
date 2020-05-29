<?php


namespace Modules\Hr\Http\Requests\EmployeeMilitary;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{
    public function rules()
    {
        return [
            'armOfServiceId' => "required|exists:hr_arm_of_services,id",
            'serviceNumber' => "required",
            'lastUnit' => "required",
            'engagedAt' => "required|date",
            'dischargedAt' => "required|date",
            'reasonToLeave' => "required"
        ];
    }

}

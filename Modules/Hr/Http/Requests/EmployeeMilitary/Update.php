<?php


namespace Modules\Hr\Http\Requests\EmployeeMilitary;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Update extends BaseRequest
{
    public function rules()
    {
        return [
            'armOfServiceId' => "sometimes|exists:hr_arm_of_services,id",
            'serviceNumber' => "sometimes",
            'lastUnit' => "sometimes",
            'engagedAt' => "sometimes|date",
            'dischargedAt' => "sometimes|date",
            'reasonToLeave' => "sometimes"
        ];
    }

}

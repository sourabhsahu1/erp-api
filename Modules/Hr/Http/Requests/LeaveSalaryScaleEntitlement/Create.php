<?php


namespace Modules\Hr\Http\Requests\LeaveSalaryScaleEntitlement;
use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{

    public function rules()
    {
        return [
            "salaryId" => "required",
            "leaveTypeId" => "required",
            "dueDays" => "required",
        ];
    }

}
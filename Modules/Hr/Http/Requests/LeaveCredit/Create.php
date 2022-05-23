<?php


namespace Modules\Hr\Http\Requests\LeaveCredit;
use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{
    public function rules()
    {
        return [
            "preparedLoginId" => "required",
            "staffId" => "required",
            "leaveTypeId" => "required",
            "dueDays" => "required",
            "leaveYearId" => "required",
            "preparedVDate" => "required",
            "preparedTDate" => "required",
        ];
    }
}
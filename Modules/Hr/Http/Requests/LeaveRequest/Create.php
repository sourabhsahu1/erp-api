<?php


namespace Modules\Hr\Http\Requests\LeaveRequest;
use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{
    public function rules()
    {
        return [
            "staffId" => "required",
            'leaveCreditId'=> 'required',
            'startDate'=> 'required',
            'reliefOfficerStaffId'=> 'required',
            'duration'=> 'required',
            'preparedVDate'=> 'required',
            'preparedTDate'=> 'required',
            'preparedLoginId'=> 'required',
            'hodStaffId'=> 'required',
            'approvedHod'=> 'nullable',
            'approvedHodVDate'=> 'nullable',
            'approvedHodTDate'=> 'nullable',
            'approvedHodLoginId'=> 'nullable',
            'approvedHrStaffId'=> 'nullable',
            'approvedHr'=> 'nullable',
            'approvedHrVDate'=> 'nullable',
            'approvedHrTDate'=> 'nullable',
            'approvedHrLoginId'=> 'nullable',
            'userRemarks'=> 'nullable',
            'hodRemarks'=> 'nullable',
            'HrRemarks'=> 'nullable',
            'requestClosed'=> 'nullable',
        ];
    }
}
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
            'daysSpent'=> 'required',
            'preparedVDate'=> 'required',
            'preparedTDate'=> 'required',
            'preparedLoginId'=> 'required',
            'requestReady'=> 'required',
            'hodStaffId'=> 'required',
            'approvedHod'=> '',
            'approvedHodVDate'=> '',
            'approvedHodTDate'=> '',
            'approvedHodLoginId'=> '',
            'approvedHrStaffId'=> '',
            'approvedHr'=> '',
            'approvedHrVDate'=> '',
            'approvedHrTDate'=> '',
            'approvedHrLoginId'=> '',
            'userRemarks'=> '',
            'hodRemarks'=> '',
            'HrRemarks'=> '',
            'requestClosed'=> '',
        ];
    }
}
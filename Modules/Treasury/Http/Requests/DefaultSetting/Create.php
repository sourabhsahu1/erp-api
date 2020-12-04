<?php


namespace Modules\Treasury\Http\Requests\DefaultSetting;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{

    public function rules()
    {
        return [
            'accountHeadId' => 'required|exists:admin_segments,id',
            'subOrganisationId' => 'required|exists:admin_segments,id',
            'adminSegmentId' => 'required|exists:admin_segments,id',
            'fundSegmentId' => 'required|exists:admin_segments,id',
            'economicSegmentId' => 'required|exists:admin_segments,id',
            'programSegmentId' => 'required|exists:admin_segments,id',
            'functionalSegmentId' => 'required|exists:admin_segments,id',
            'geoCodeSegmentId' => 'required|exists:admin_segments,id',
            'checkingOfficerId' => 'required|exists:hr_employees,id',
            'payingOfficerId' => 'required|exists:hr_employees,id',
            'financialControllerId' => 'required|exists:hr_employees,id'
        ];
    }
}


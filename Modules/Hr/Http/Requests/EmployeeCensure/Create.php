<?php


namespace Modules\Hr\Http\Requests\EmployeeCensure;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{
    public function rules()
    {
        return [
            'issuedById' => "required|exists:hr_employees,id",
            'censureId' => "required|exists:hr_censures,id",
            'dateIssued' => "required|date",
            'fileId' => "required|exists:files,id",
            'documentType' => "required",
            'filePage' => "required",
            'summary' => "required"
        ];
    }

}

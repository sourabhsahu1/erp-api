<?php


namespace Modules\Hr\Http\Requests\EmployeeCensure;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Update extends BaseRequest
{
    public function rules()
    {
        return [
            'issuedById' => "sometimes|exists:hr_employees,id",
            'censureId' => "sometimes|exists:hr_censures,id",
            'dateIssued' => "sometimes|date",
            'fileId' => "sometimes|exists:files,id",
            'documentType' => "sometimes",
            'filePage' => "sometimes",
            'summary' => "sometimes"
        ];
    }

}

<?php


namespace Modules\Hr\Http\Requests\EmployeeQualification;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Update extends BaseRequest
{
    public function rules()
    {
        return [
            'qualificationId' => "sometimes|exists:hr_qualifications,id",
            'academicId' => "sometimes|exists:hr_academics,id",
            'countryId'=> "sometimes|exists:countries,id",
            'instituteName'=> "sometimes"
        ];
    }

}

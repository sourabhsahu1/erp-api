<?php


namespace Modules\Hr\Http\Requests\EmployeeQualification;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{
    public function rules()
    {
        return [
            'qualificationId' => "required|exists:hr_qualifications,id",
            'academicId' => "required|exists:hr_academics,id",
            'countryId'=> "required|exists:countries,id",
            'instituteName'=> "required"
        ];
    }

}

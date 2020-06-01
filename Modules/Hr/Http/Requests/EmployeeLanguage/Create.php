<?php


namespace Modules\Hr\Http\Requests\EmployeeLanguage;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{
    public function rules()
    {
        return [
            'languageId' => "required|exists:hr_languages,id",
            'writtenProficiency' => "required",
            'spokenProficiency' => "required",
            'certification' => "required",
            'description' => "sometimes"
        ];
    }

}

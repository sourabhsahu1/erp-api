<?php


namespace Modules\Hr\Http\Requests\EmployeeLanguage;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Update extends BaseRequest
{
    public function rules()
    {
        return [
            'languageId' => "sometimes|exists:hr_languages,id",
            'writtenProficiency' => "sometimes",
            'spokenProficiency' => "sometimes",
            'certification' => "sometimes",
            'description' => "sometimes"
        ];
    }

}

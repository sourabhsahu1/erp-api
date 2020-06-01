<?php


namespace Modules\Hr\Http\Requests\EmployeeLanguage;


use App\Constants\AppConstant;
use Illuminate\Validation\Rule;
use Luezoid\Laravelcore\Requests\BaseRequest;

class Update extends BaseRequest
{
    public function rules()
    {
        return [
            'languageId' => "sometimes|exists:hr_languages,id",
            'writtenProficiency' => ["sometimes",
                Rule::in([
                    AppConstant::LANGUAGE_PROFICIENCY_VERY_GOOD,
                    AppConstant::LANGUAGE_PROFICIENCY_GOOD,
                    AppConstant::LANGUAGE_PROFICIENCY_POOR,
                    AppConstant::LANGUAGE_PROFICIENCY_NO
                ])],
            'spokenProficiency'  => ["sometimes",
                Rule::in([
                    AppConstant::LANGUAGE_PROFICIENCY_VERY_GOOD,
                    AppConstant::LANGUAGE_PROFICIENCY_GOOD,
                    AppConstant::LANGUAGE_PROFICIENCY_POOR,
                    AppConstant::LANGUAGE_PROFICIENCY_NO
                ])],
            'certification' => "sometimes",
            'description' => "sometimes"
        ];
    }

}

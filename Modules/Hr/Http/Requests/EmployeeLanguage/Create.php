<?php


namespace Modules\Hr\Http\Requests\EmployeeLanguage;


use App\Constants\AppConstant;
use Illuminate\Validation\Rule;
use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{
    public function rules()
    {
        return [
            'languageId' => "required|exists:hr_languages,id",
            'writtenProficiency' => ["required",
                Rule::in([
                    AppConstant::LANGUAGE_PROFICIENCY_VERY_GOOD,
                    AppConstant::LANGUAGE_PROFICIENCY_GOOD,
                    AppConstant::LANGUAGE_PROFICIENCY_POOR,
                    AppConstant::LANGUAGE_PROFICIENCY_NO
                ])],
            'spokenProficiency' => ["required",
                Rule::in([
                    AppConstant::LANGUAGE_PROFICIENCY_VERY_GOOD,
                    AppConstant::LANGUAGE_PROFICIENCY_GOOD,
                    AppConstant::LANGUAGE_PROFICIENCY_POOR,
                    AppConstant::LANGUAGE_PROFICIENCY_NO
                ])],
            'certification' => "required",
            'description' => "sometimes"
        ];
    }

}

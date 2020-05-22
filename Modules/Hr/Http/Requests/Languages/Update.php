<?php


namespace Modules\Hr\Http\Requests\Languages;


use Illuminate\Validation\Rule;
use Luezoid\Laravelcore\Requests\BaseRequest;

class Update extends BaseRequest
{
    public function rules()
    {
        $id = $this->get('language');
        return [
            "name" => ["required", Rule::unique('hr_languages')->ignore($id)],
            "isActive" => "required|boolean"
        ];
    }

}
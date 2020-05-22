<?php


namespace Modules\Hr\Http\Requests\Skills;


use Illuminate\Validation\Rule;
use Luezoid\Laravelcore\Requests\BaseRequest;

class Update extends BaseRequest
{
    public function rules()
    {
        $id = $this->route('skill');
        return [
            "name" => ["required", Rule::unique('hr_skills')->ignore($id)],
            "isActive" => "required|boolean"
        ];
    }

}
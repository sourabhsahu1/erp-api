<?php


namespace Modules\Hr\Http\Requests\Qualification;


use Illuminate\Validation\Rule;
use Luezoid\Laravelcore\Requests\BaseRequest;

class Update extends BaseRequest
{
    public function rules()
    {
        $id = $this->route('qualification');
        return [
            "name" => ["required", Rule::unique('hr_qualifications')->ignore($id)],
            "isActive" => "required|boolean"
        ];
    }

}
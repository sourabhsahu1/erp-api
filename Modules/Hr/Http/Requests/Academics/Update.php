<?php


namespace Modules\Hr\Http\Requests\Academics;


use Illuminate\Validation\Rule;
use Luezoid\Laravelcore\Requests\BaseRequest;

class Update extends BaseRequest
{
    public function rules()
    {
        $id = $this->route('academic');
        return [
            "name" => ["required", Rule::unique('hr_academics')->ignore($id)],
            "isActive" => "required|boolean"
        ];
    }

}
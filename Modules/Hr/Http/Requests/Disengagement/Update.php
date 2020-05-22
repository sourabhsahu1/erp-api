<?php


namespace Modules\Hr\Http\Requests\Disengagement;


use Illuminate\Validation\Rule;
use Luezoid\Laravelcore\Requests\BaseRequest;

class Update extends BaseRequest
{
    public function rules()
    {
        $id = $this->route('disengagement');
        return [
            "name" => ["required", Rule::unique('hr_disengagements')->ignore($id)],
            "isActive" => "required|boolean"
        ];
    }

}
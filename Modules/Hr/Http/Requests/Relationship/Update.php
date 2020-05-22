<?php


namespace Modules\Hr\Http\Requests\Relationship;


use Illuminate\Validation\Rule;
use Luezoid\Laravelcore\Requests\BaseRequest;

class Update extends BaseRequest
{
    public function rules()
    {

        $id = $this->route('relationship');
        return [
            "name" => ["required", Rule::unique('hr_relationships')->ignore($id)],
            "isActive" => "required|boolean"
        ];
    }

}
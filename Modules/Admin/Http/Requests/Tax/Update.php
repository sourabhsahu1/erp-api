<?php


namespace Modules\Admin\Http\Requests\Tax;


use Illuminate\Validation\Rule;
use Luezoid\Laravelcore\Requests\BaseRequest;

class Update extends BaseRequest
{

    public function rules()
    {
        return [
            'name' => ["sometimes", Rule::unique('admin_taxes', 'name')->ignore($this->inputs['id'])->whereNull('deleted_at')],
            'tax' => ['sometimes', 'between:0,99.99'],
            'isActive' => 'sometimes|boolean',
            'departmentId' => 'sometimes|exists:admin_segments,id',
            'companyId' => 'sometimes|exists:admin_companies,id'
        ];
    }
}

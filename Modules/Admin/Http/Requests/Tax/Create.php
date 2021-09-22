<?php


namespace Modules\Admin\Http\Requests\Tax;


use Illuminate\Validation\Rule;
use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{

    public function rules()
    {
        return [
            'name' => ["required", Rule::unique('admin_taxes','name')->whereNull('deleted_at')],
            'tax' => 'required|between:0,99.99',
            'isActive' => 'required|boolean',
            'departmentId' => 'required|exists:admin_segments,id',
            'companyId' => 'required|exists:admin_companies,id'
        ];
    }
}

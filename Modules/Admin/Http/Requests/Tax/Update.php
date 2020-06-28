<?php


namespace Modules\Admin\Http\Requests\Tax;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Update extends BaseRequest
{

    public function rules()
    {
       return [
           'name' => 'sometimes',
           'tax' => 'sometimes|between:0,99.99',
           'isActive' => 'sometimes|boolean',
           'departmentId' => 'sometimes|exists:admin_segments,id',
           'companyId' => 'sometimes|exists:admin_companies,id'
       ];
    }
}

<?php


namespace Modules\Inventory\Http\Requests\Store;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{

    public function rules()
    {
        return [
            "name" => "required",
            "isActive" => "required|boolean"
        ];
    }
}

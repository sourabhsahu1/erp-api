<?php


namespace Modules\Inventory\Http\Requests\Category;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Update  extends BaseRequest
{

    public function rules()
    {
        return [
            "name" => "sometimes",
            "isActive" => "sometimes|boolean"
        ];
    }
}

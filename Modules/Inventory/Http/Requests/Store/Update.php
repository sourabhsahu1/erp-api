<?php


namespace Modules\Inventory\Http\Requests\Store;


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

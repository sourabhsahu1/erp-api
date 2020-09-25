<?php


namespace Modules\Finance\Http\Requests;


use Luezoid\Laravelcore\Requests\BaseRequest;

class CreateBankRequest extends BaseRequest
{
    public function rules()
    {
        return [
            "name" =>"required|string"
        ];
    }
}

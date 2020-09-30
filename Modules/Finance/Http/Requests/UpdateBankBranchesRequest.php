<?php


namespace Modules\Finance\Http\Requests;


use Luezoid\Laravelcore\Requests\BaseRequest;

class UpdateBankBranchesRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string',
            'country' => 'required|string',
            'sortCode' => 'required|integer',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' =>'required|string',
            'isActive' => 'required|boolean'
        ];
    }
}

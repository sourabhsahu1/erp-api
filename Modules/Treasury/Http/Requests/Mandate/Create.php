<?php

namespace Modules\Treasury\Http\Requests\Mandate;

use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{
    public function rules()
    {
        return [
            "cashbookId" => ["required"],
            "batchNumber" => ["required"],
            "treasuryNumber" => ["required"],
            "valueDate" => ["required"],
            "instructions" => ["required"]
        ];
    }

}

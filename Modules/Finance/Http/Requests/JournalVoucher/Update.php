<?php


namespace Modules\Finance\Http\Requests\JournalVoucher;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Update extends BaseRequest
{

    public function rules()
    {
        return [
            'batchNumber' => 'sometimes',
            'jvValueSate' => 'sometimes',
            'fundSegmentId' => 'sometimes|exists:admin_segments,id',
            'jvReference' => 'sometimes',
            'transactionDetails' => 'sometimes',
            'preparedValueDate' => 'sometimes',
            'preparedTransactionDate' => 'sometimes'
        ];
    }
}

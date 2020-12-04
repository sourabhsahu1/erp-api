<?php


namespace Modules\Finance\Http\Requests\JournalVoucher;


use Luezoid\Laravelcore\Requests\BaseRequest;
use Modules\Finance\Models\JournalVoucher;

class Create extends BaseRequest
{

    public function rules()
    {


        return [
            'batchNumber' => 'required',
            'jvValueDate' => 'required',
            'fundSegmentId' => 'required|exists:admin_segments,id',
            'jvReference' => 'required',
            'transactionDetails' => 'required',
            'preparedValueDate' => 'required',
            'preparedTransactionDate' => 'required',
            'jvDetail' => 'array',
            'jvDetail.*.currency' => 'required',
            'jvDetail.*.xRateLocal' => 'required',
            'jvDetail.*.bankXRateToUsd' => 'required',
            'jvDetail.*.accountName' => 'required',
            'jvDetail.*.lineReference' => 'required',
            'jvDetail.*.lineValue' => 'required',
            'jvDetail.*.adminSegmentId' => 'required|exists:admin_segments,id',
            'jvDetail.*.fundSegmentId' => 'required|exists:admin_segments,id',
            'jvDetail.*.economicSegmentId' => 'required|exists:admin_segments,id',
            'jvDetail.*.programmeSegmentId' => 'required|exists:admin_segments,id',
            'jvDetail.*.functionalSegmentId' => 'required|exists:admin_segments,id',
            'jvDetail.*.geoCodeSegmentId' => 'required|exists:admin_segments,id',
            'jvDetail.*.lineValueType' => 'required',
            'jvDetail.*.lvLineValue' => 'required'
        ];
    }
}

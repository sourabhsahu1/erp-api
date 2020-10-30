<?php


namespace Modules\Finance\Http\Requests\JournalVoucherDetail;


use App\Constants\AppConstant;
use Illuminate\Validation\Rule;
use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Requests\BaseRequest;
use Modules\Finance\Models\JournalVoucher;
use Modules\Finance\Models\JournalVoucherDetail;

class Update extends BaseRequest
{
    public function rules()
    {

        /** @var JournalVoucher $jv */
        $jv = JournalVoucher::find($this->route('id'));
        if ($jv->status == AppConstant::JV_STATUS_POSTED) {
            throw new AppException('Cannot Update Status is not NEW');
        }

//        $jvD = JournalVoucherDetail::where('journal_voucher_id', $this->route('id'))->get();
//        $lv['CREDIT'] = 0;
//        $lv['DEBIT'] = 0;
//        foreach ($jvD as $item) {
//            $lv[$item['line_value_type']] += $item['lv_line_value'];
//        }
//        if ($lv['CREDIT'] > $lv['DEBIT']) {
//            if ($this->get('lineValueType') == AppConstant::LINE_VALUE_TYPE_DEBIT) {
//                if (($lv['CREDIT'] - $lv['DEBIT']) != $this->get('lvLineValue')) {
//                    throw new AppException('Entered amount is not applicable');
//                }
//            } else {
//                throw new  AppException('Cannot add');
//            }
//        } elseif ($lv['CREDIT'] < $lv['DEBIT']) {
//            if ($this->get('lineValueType') == AppConstant::LINE_VALUE_TYPE_CREDIT) {
//                if (($lv['DEBIT'] - $lv['CREDIT']) != $this->get('lvLineValue')) {
//                    throw new AppException('Entered amount is not applicable');
//                }
//            } else {
//                throw new  AppException('Cannot add');
//            }
//        }

        return [
            'currency' => 'sometimes',
            'xRateLocal' => 'sometimes|numeric|between:0,99.99',
            'bankXRateToUsd' => 'sometimes|numeric|between:0,99.99',
            'accountName' => 'sometimes',
            'lineReference' => 'sometimes',
            'lineValue' => 'sometimes',
            'adminSegmentId' => 'sometimes|exists:admin_segments,id',
            'fundSegmentId' => 'sometimes|exists:admin_segments,id',
            'economicSegmentId' => 'sometimes|exists:admin_segments,id',
            'programmeSegmentId' => 'sometimes|exists:admin_segments,id',
            'functionalSegmentId' => 'sometimes|exists:admin_segments,id',
            'geoCodeSegmentId' => 'sometimes|exists:admin_segments,id',
            'lineValueType' => [
                'required',
                Rule::in([
                    AppConstant::LINE_VALUE_TYPE_DEBIT,
                    AppConstant::LINE_VALUE_TYPE_CREDIT
                ])
            ],
            'lvLineValue' => 'sometimes|numeric|between:0,999999.99'
        ];
    }

}


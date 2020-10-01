<?php


namespace Modules\Finance\Http\Requests\JournalVoucherDetail;


use App\Constants\AppConstant;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Requests\BaseRequest;
use Modules\Finance\Models\JournalVoucher;
use Modules\Finance\Models\JournalVoucherDetail;

class Create extends BaseRequest
{
    public function rules()
    {


        /** @var JournalVoucher $jv */
        $jv = JournalVoucher::find($this->route('id'));
        if ($jv->status != AppConstant::JV_STATUS_NEW) {
            throw new AppException('Cannot Add Status is not NEW');
        }


        $jvD = JournalVoucherDetail::where('journal_voucher_id', $this->route('id'))->get();
        $lv['CREDIT'] = 0;
        $lv['DEBIT'] = 0;
        foreach ($jvD as $item) {
            $lv[$item['line_value_type']] += $item['lv_line_value'];
        }
        if ($lv['CREDIT'] == $lv['DEBIT']) {
            throw new  AppException('Cannot add more');
        }

        if ($lv['CREDIT'] > $lv['DEBIT']) {
            if ($this->get('lineValueType') == AppConstant::LINE_VALUE_TYPE_DEBIT) {
                if (($lv['CREDIT'] - $lv['DEBIT']) != $this->get('lvLineValue')) {
                    throw new AppException('Entered amount is not applicable');
                }
            }else {
                throw new  AppException('Cannot add');
            }
        }
        if ($lv['CREDIT'] < $lv['DEBIT']) {
            if ($this->get('lineValueType') == AppConstant::LINE_VALUE_TYPE_CREDIT) {
                if (($lv['DEBIT'] - $lv['CREDIT']) != $this->get('lvLineValue')) {
                    throw new AppException('Entered amount is not applicable');
                }
            }else {
                throw new  AppException('Cannot add');
            }
        }

        return [
            'currency' => 'required',
            'xRateLocal' => 'required|numeric|between:0,99.99',
            'bankXRateToUsd' => 'required|numeric|between:0,99.99',
            'accountName' => 'required',
            'lineReference' => 'required',
            'lineValue' => 'required',
            'adminSegmentId' => 'required|exists:admin_segments,id',
            'fundSegmentId' => 'required|exists:admin_segments,id',
            'economicSegmentId' => 'required|exists:admin_segments,id',
            'programmeSegmentId' => 'required|exists:admin_segments,id',
            'functionalSegmentId' => 'required|exists:admin_segments,id',
            'geoCodeSegmentId' => 'required|exists:admin_segments,id',
            'lineValueType' => [
                Rule::in([
                    AppConstant::LINE_VALUE_TYPE_DEBIT,
                    AppConstant::LINE_VALUE_TYPE_CREDIT
                ])
            ],
            'lvLineValue' => 'required|numeric|between:0,9999999.99'
        ];
    }

}

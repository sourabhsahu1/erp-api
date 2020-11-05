<?php


namespace Modules\Finance\Http\Requests\Budget;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{
    public function rules()
    {
        return [
            'adminSegmentId' => 'required|exists:admin_segments,id',
            'fundSegmentId' => 'required|exists:admin_segments,id',
            'economicSegmentId' => ['required_without:programSegmentId', function ($a, $v, $f) {
                if (!is_null($v)) {
                    if (!is_null($this->get('programSegmentId'))) {
                        return $f('economicSegmentId only required when programSegmentId is null');
                    }
                }
            }],
            'programSegmentId'  => ['required_without:economicSegmentId', function ($a, $v, $f) {
                if (!is_null($v)) {
                    if (!is_null($this->get('economicSegmentId'))) {
                        return $f('programSegmentId only required when economicSegmentId is null');
                    }
                }
            }],
            'xRateLocal' => 'required',
            'xRateToInternational' => 'required',
            'currencyId' => 'required',
            'budgetAmount' => 'required',
            'previousYearAmount' => '',
            'previousYearActualAmount' => '',
            'cumulativePreviousYearAmount' => '',
            'cumulativePreviousYearActualAmount' => '',
            'budgetBreakups' => 'required|array',
            'budgetBreakups.*.month' => 'required',
            'budgetBreakups.*.mainBudget' => 'required',
            'budgetBreakups.*.supplementaryBudget' => 'sometimes'

        ];
    }
}

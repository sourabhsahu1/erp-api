<?php


namespace Modules\Finance\Http\Requests\Budget;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Update  extends BaseRequest
{
    public function rules()
    {
        return [
            'adminSegmentId' => 'sometimes|exists:admin_segments,id',
            'fundSegmentId' => 'sometimes|exists:admin_segments,id',
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
            'xRateLocal' => 'sometimes',
            'xRateToInternational' => 'sometimes',
            'currencyId' => 'sometimes',
            'budgetAmount' => 'sometimes',
            'previousYearAmount' => '',
            'previousYearActualAmount' => '',
            'cumulativePreviousYearAmount' => '',
            'cumulativePreviousYearActualAmount' => '',
            'budgetBreakups' => 'sometimes|array',
            'budgetBreakups.*.month' => 'sometimes',
            'budgetBreakups.*.mainBudget' => 'sometimes',
            'budgetBreakups.*.supplementaryBudget' => 'sometimes'
        ];
    }
}

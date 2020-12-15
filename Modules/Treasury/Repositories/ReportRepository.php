<?php


namespace Modules\Treasury\Repositories;


use App\Constants\AppConstant;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Admin\Models\AdminSegment;
use Modules\Treasury\Models\PayeeVoucher;
use Modules\Treasury\Models\PaymentVoucher;
use Modules\Treasury\Models\ReceiptPayee;
use Modules\Treasury\Models\ReceiptVoucher;

class ReportRepository extends EloquentBaseRepository
{

    private function getChildIds(&$data)
    {
        $childIds = [];
        $childIds[] = $data['id'];

        foreach ($data['children'] as &$child) {
            $child['child_ids'] = $this->getChildIds($child);
            $childIds = array_merge($childIds, $child['child_ids']);
        }

        return $childIds;
    }

    public function summaryNonPersonalAdvances($params)
    {

        $pv = PaymentVoucher::query();

        if (isset($params['inputs']['from_date']) && isset($params['inputs']['to_date'])) {
            $fromDate = Carbon::parse($params['inputs']['from_date'])->toDateTimeString();
            $toDate = Carbon::parse($params['inputs']['to_date'])->toDateString() . ' 23:59:59';

            $pv->whereDate('value_date', '>=', $fromDate)
                ->whereDate('value_date', '<=', $toDate);
        }

        if (isset($params['inputs']['admin_segment_ids'])) {

            $pv->whereIn('admin_segment_id', json_decode($params['inputs']['admin_segment_ids']))
                ->selectRaw('admin_segment_id,admin_segments.name,SUM(net_amount+total_tax) as amount')
                ->join('treasury_payee_vouchers', 'treasury_payment_vouchers.id', '=', 'treasury_payee_vouchers.payment_voucher_id')
                ->join('admin_segments', 'admin_segments.id', '=', 'treasury_payment_vouchers.admin_segment_id')
                ->whereNull('company_id')
                ->where('type', AppConstant::VOUCHER_TYPE_NON_PERSONAL_VOUCHER)
                ->groupby('treasury_payment_vouchers.admin_segment_id');
        } elseif (isset($params['inputs']['admin _segment_id']) && isset($params['inputs']['employee_id'])) {
            $pv->whereHas('payee_vouchers', function ($query) use ($params) {
                $query->where('employee_id', $params['inputs']['employee_id']);
            })
                ->where('admin_segment_id', $params['inputs']['admin_segment_id'])
                ->where('type', AppConstant::VOUCHER_TYPE_NON_PERSONAL_VOUCHER)
                ->with([
                    'program_segment',
                    'economic_segment',
                    'functional_segment',
                    'geo_code_segment',
                    'admin_segment',
                    'fund_segment',
                    'aie',
                    'employee',
                    'currency',
                    'voucher_source_unit',
                    'total_amount',
                    'total_tax',
                    'payee_vouchers'
                ]);

        } elseif (isset($params['inputs']['admin_segment_id'])) {

            $pv->selectRaw('admin_segment_id,hr_employees.id as employee_id,hr_employees.first_name as first_name,hr_employees.last_name as last_name,SUM(net_amount+total_tax) as amount')
                ->join('treasury_payee_vouchers', 'treasury_payment_vouchers.id', '=', 'treasury_payee_vouchers.payment_voucher_id')
                ->join('hr_employees', 'hr_employees.id', '=', 'treasury_payee_vouchers.employee_id')
                ->join('admin_segments', 'admin_segments.id', '=', 'treasury_payment_vouchers.admin_segment_id')
                ->where('admin_segment_id', $params['inputs']['admin_segment_id'])
                ->where('type', AppConstant::VOUCHER_TYPE_NON_PERSONAL_VOUCHER)
                ->groupby(['admin_segment_id', 'hr_employees.id']);
        } else {
            $pv->join('treasury_payee_vouchers', 'treasury_payment_vouchers.id', '=', 'treasury_payee_vouchers.payment_voucher_id')
                ->join('admin_segments', 'admin_segments.id', '=', 'treasury_payment_vouchers.admin_segment_id')
                ->whereNull('company_id')
                ->where('type', AppConstant::VOUCHER_TYPE_NON_PERSONAL_VOUCHER)
                ->select(DB::raw('SUM(net_amount+total_tax) as amount'));
            $pv = $pv->get()->toArray();


        }

        return $pv->get();

    }


    public function summaryPersonalAdvances($params)
    {

        $pv = PaymentVoucher::selectRaw('admin_segment_id,admin_segments.name,SUM(net_amount+total_tax) as amount')
            ->join('treasury_payee_vouchers', 'treasury_payment_vouchers.id', '=', 'treasury_payee_vouchers.payment_voucher_id')
            ->join('admin_segments', 'admin_segments.id', '=', 'treasury_payment_vouchers.admin_segment_id')
            ->whereNull('company_id')
            ->where('type', AppConstant::VOUCHER_TYPE_PERSONAL_ADVANCES_VOUCHER)
            ->groupby('treasury_payment_vouchers.admin_segment_id');

        if (isset($params['inputs']['admin_segment_ids'])) {

            $pv = PaymentVoucher::whereIn('admin_segment_id', json_decode($params['inputs']['admin_segment_ids']))
                ->selectRaw('admin_segment_id,admin_segments.name,SUM(net_amount+total_tax) as amount')
                ->join('treasury_payee_vouchers', 'treasury_payment_vouchers.id', '=', 'treasury_payee_vouchers.payment_voucher_id')
                ->join('admin_segments', 'admin_segments.id', '=', 'treasury_payment_vouchers.admin_segment_id')
                ->whereNull('company_id')
                ->where('type', AppConstant::VOUCHER_TYPE_NON_PERSONAL_VOUCHER)
                ->groupby('treasury_payment_vouchers.admin_segment_id');
        } elseif (isset($params['inputs']['admin_segment_id']) && isset($params['inputs']['employee_id'])) {
            $pv = PaymentVoucher::whereHas('payee_vouchers', function ($query) use ($params) {
                $query->where('employee_id', $params['inputs']['employee_id']);
            })
                ->where('admin_segment_id', $params['inputs']['admin_segment_id'])
                ->where('type', AppConstant::VOUCHER_TYPE_NON_PERSONAL_VOUCHER)
                ->with([
                    'program_segment',
                    'economic_segment',
                    'functional_segment',
                    'geo_code_segment',
                    'admin_segment',
                    'fund_segment',
                    'aie',
                    'employee',
                    'currency',
                    'voucher_source_unit',
                    'total_amount',
                    'total_tax',
                    'payee_vouchers'
                ]);

        } elseif (isset($params['inputs']['admin_segment_id'])) {

            $pv = PayeeVoucher::where('admin_segment_id', $params['inputs']['admin_segment_id'])
                ->selectRaw('admin_segment_id,hr_employees.id as employee_id,hr_employees.first_name as first_name,hr_employees.last_name as last_name,SUM(net_amount+total_tax) as amount')
                ->join('treasury_payment_vouchers', 'treasury_payment_vouchers.id', '=', 'treasury_payee_vouchers.payment_voucher_id')
                ->join('hr_employees', 'hr_employees.id', '=', 'treasury_payee_vouchers.employee_id')
                ->join('admin_segments', 'admin_segments.id', '=', 'treasury_payment_vouchers.admin_segment_id')
                ->where('type', AppConstant::VOUCHER_TYPE_NON_PERSONAL_VOUCHER)
                ->groupby(['admin_segment_id', 'hr_employees.id']);
        }


        if (isset($params['inputs']['from_date']) && isset($params['inputs']['to_date'])) {
            $fromDate = Carbon::parse($params['inputs']['from_date'])->toDateTimeString();
            $toDate = Carbon::parse($params['inputs']['to_date'])->toDateString() . ' 23:59:59';

            $pv->whereDate('value_date', '>=', $fromDate)
                ->whereDate('value_date', '<=', $toDate);
        }

        return $pv->get();

    }


    public function summaryStandingImprest($params)
    {

        $pv = ReceiptVoucher::selectRaw('admin_segment_id,admin_segments.name,SUM(total_amount) as amount')
            ->join('treasury_receipt_payees', 'treasury_receipt_vouchers.id', '=', 'treasury_receipt_payees.receipt_voucher_id')
            ->join('admin_segments', 'admin_segments.id', '=', 'treasury_receipt_vouchers.admin_segment_id')
            ->whereNull('company_id')
            ->where('type', AppConstant::VOUCHER_TYPE_STANDING_IMPREST_RECEIVED_VOUCHER)
            ->groupby('treasury_receipt_vouchers.admin_segment_id');

        if (isset($params['inputs']['admin_segment_ids'])) {

            $pv = ReceiptVoucher::whereIn('admin_segment_id', json_decode($params['inputs']['admin_segment_ids']))
                ->selectRaw('admin_segment_id,admin_segments.name,SUM(net_amount+total_tax) as amount')
                ->join('treasury_receipt_payees', 'treasury_receipt_vouchers.id', '=', 'treasury_receipt_payees.receipt_voucher_id')
                ->join('admin_segments', 'admin_segments.id', '=', 'treasury_receipt_vouchers.admin_segment_id')
                ->whereNull('company_id')
                ->where('type', AppConstant::VOUCHER_TYPE_NON_PERSONAL_VOUCHER)
                ->groupby('treasury_receipt_vouchers.admin_segment_id');
        } elseif (isset($params['inputs']['admin_segment_id']) && isset($params['inputs']['employee_id'])) {
            $pv = ReceiptVoucher::whereHas('payee_vouchers', function ($query) use ($params) {
                $query->where('employee_id', $params['inputs']['employee_id']);
            })
                ->where('admin_segment_id', $params['inputs']['admin_segment_id'])
                ->where('type', AppConstant::VOUCHER_TYPE_NON_PERSONAL_VOUCHER)
                ->with([
                    'program_segment',
                    'economic_segment',
                    'functional_segment',
                    'geo_code_segment',
                    'admin_segment',
                    'fund_segment',
                    'aie',
                    'employee',
                    'currency',
                    'voucher_source_unit',
                    'total_amount',
                    'receipt_payees'
                ]);

        } elseif (isset($params['inputs']['admin_segment_id'])) {

            $pv = ReceiptPayee::where('admin_segment_id', $params['inputs']['admin_segment_id'])
                ->selectRaw('admin_segment_id,hr_employees.id as employee_id,hr_employees.first_name as first_name,hr_employees.last_name as last_name,SUM(net_amount+total_tax) as amount')
                ->join('treasury_receipt_vouchers', 'treasury_receipt_vouchers.id', '=', 'treasury_receipt_payees.receipt_voucher_id')
                ->join('hr_employees', 'hr_employees.id', '=', 'treasury_receipt_payees.employee_id')
                ->join('admin_segments', 'admin_segments.id', '=', 'treasury_receipt_vouchers.admin_segment_id')
                ->where('type', AppConstant::VOUCHER_TYPE_NON_PERSONAL_VOUCHER)
                ->groupby(['admin_segment_id', 'hr_employees.id']);
        }


        if (isset($params['inputs']['from_date']) && isset($params['inputs']['to_date'])) {
            $fromDate = Carbon::parse($params['inputs']['from_date'])->toDateTimeString();
            $toDate = Carbon::parse($params['inputs']['to_date'])->toDateString() . ' 23:59:59';

            $pv->whereDate('value_date', '>=', $fromDate)
                ->whereDate('value_date', '<=', $toDate);
        }

        return $pv->get();

    }


    public function summarySpecialImprest($params)
    {

        $pv = ReceiptVoucher::selectRaw('admin_segment_id,admin_segments.name,SUM(total_amount) as amount')
            ->join('treasury_receipt_payees', 'treasury_receipt_vouchers.id', '=', 'treasury_receipt_payees.receipt_voucher_id')
            ->join('admin_segments', 'admin_segments.id', '=', 'treasury_receipt_vouchers.admin_segment_id')
            ->whereNull('company_id')
            ->where('type', AppConstant::VOUCHER_TYPE_SPECIAL_IMPREST_RECEIVED_VOUCHER)
            ->groupby('treasury_receipt_vouchers.admin_segment_id');

        if (isset($params['inputs']['admin_segment_ids'])) {

            $pv = ReceiptVoucher::whereIn('admin_segment_id', json_decode($params['inputs']['admin_segment_ids']))
                ->selectRaw('admin_segment_id,admin_segments.name,SUM(net_amount+total_tax) as amount')
                ->join('treasury_receipt_payees', 'treasury_receipt_vouchers.id', '=', 'treasury_receipt_payees.receipt_voucher_id')
                ->join('admin_segments', 'admin_segments.id', '=', 'treasury_receipt_vouchers.admin_segment_id')
                ->whereNull('company_id')
                ->where('type', AppConstant::VOUCHER_TYPE_NON_PERSONAL_VOUCHER)
                ->groupby('treasury_receipt_vouchers.admin_segment_id');
        } elseif (isset($params['inputs']['admin_segment_id']) && isset($params['inputs']['employee_id'])) {
            $pv = ReceiptVoucher::whereHas('payee_vouchers', function ($query) use ($params) {
                $query->where('employee_id', $params['inputs']['employee_id']);
            })
                ->where('admin_segment_id', $params['inputs']['admin_segment_id'])
                ->where('type', AppConstant::VOUCHER_TYPE_NON_PERSONAL_VOUCHER)
                ->with([
                    'program_segment',
                    'economic_segment',
                    'functional_segment',
                    'geo_code_segment',
                    'admin_segment',
                    'fund_segment',
                    'aie',
                    'employee',
                    'currency',
                    'voucher_source_unit',
                    'total_amount',
                    'receipt_payees'
                ]);

        } elseif (isset($params['inputs']['admin_segment_id'])) {

            $pv = PayeeVoucher::where('admin_segment_id', $params['inputs']['admin_segment_id'])
                ->selectRaw('admin_segment_id,hr_employees.id as employee_id,hr_employees.first_name as first_name,hr_employees.last_name as last_name,SUM(net_amount+total_tax) as amount')
                ->join('treasury_receipt_vouchers', 'treasury_receipt_vouchers.id', '=', 'treasury_receipt_payees.receipt_voucher_id')
                ->join('hr_employees', 'hr_employees.id', '=', 'treasury_receipt_payees.employee_id')
                ->join('admin_segments', 'admin_segments.id', '=', 'treasury_receipt_vouchers.admin_segment_id')
                ->where('type', AppConstant::VOUCHER_TYPE_NON_PERSONAL_VOUCHER)
                ->groupby(['admin_segment_id', 'hr_employees.id']);
        }


        if (isset($params['inputs']['from_date']) && isset($params['inputs']['to_date'])) {
            $fromDate = Carbon::parse($params['inputs']['from_date'])->toDateTimeString();
            $toDate = Carbon::parse($params['inputs']['to_date'])->toDateString() . ' 23:59:59';

            $pv->whereDate('value_date', '>=', $fromDate)
                ->whereDate('value_date', '<=', $toDate);
        }

        return $pv->get();

    }

}

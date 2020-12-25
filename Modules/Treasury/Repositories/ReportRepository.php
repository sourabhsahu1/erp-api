<?php


namespace Modules\Treasury\Repositories;


use App\Constants\AppConstant;
use App\Services\UtilityService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Admin\Models\AdminSegment;
use Modules\Treasury\Models\PayeeVoucher;
use Modules\Treasury\Models\PaymentVoucher;
use Modules\Treasury\Models\ReceiptPayee;
use Modules\Treasury\Models\ReceiptScheduleEconomic;
use Modules\Treasury\Models\ReceiptVoucher;
use Modules\Treasury\Models\ScheduleEconomic;

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


    public function getAllChildren($id)
    {
        $segments = AdminSegment::with('children');
        $economicChilds = AdminSegment::where('parent_id', $id)->get()->pluck('id');

        if (isset($params['inputs']['parent_id'])) {
            $segments->where('parent_id', $id);
        } else {
            $segments->whereIn('id', $economicChilds);
        }

        $segments = $segments->get()->toArray();
        $childIds = [];

        foreach ($segments as &$segment) {
            $segment['child_ids'] = [];
            $segment['child_ids'] = $this->getChildIds($segment);
            $childIds = array_merge($childIds, $segment['child_ids']);
            unset($segment['children']);
        }

        return $segments;
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


        if (isset($params['inputs']['admin_segment_id']) && isset($params['inputs']['employee_id'])) {
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
        } elseif (isset($params['inputs']['admin_segment_ids'])) {
            $adminSegmentData = $this->getAllChildren($params['inputs']['admin_segment_ids']);
            $adminSegmentsIds = [];
            foreach ($adminSegmentData as $segment) {
                $adminSegmentsIds = array_merge($adminSegmentsIds, $segment['child_ids']);
            }

            $pv->selectRaw('admin_segment_id,admin_segments.name,SUM(net_amount+total_tax) as amount')
                ->join('treasury_payee_vouchers', 'treasury_payment_vouchers.id', '=', 'treasury_payee_vouchers.payment_voucher_id')
                ->join('admin_segments', 'admin_segments.id', '=', 'treasury_payment_vouchers.admin_segment_id')
                ->whereNull('company_id')
                ->where('type', AppConstant::VOUCHER_TYPE_NON_PERSONAL_VOUCHER)
                ->whereIn('admin_segment_id', $adminSegmentsIds)
                ->groupby('treasury_payment_vouchers.admin_segment_id');

        } else {
            $pv->selectRaw('admin_segment_id,admin_segments.name,SUM(net_amount+total_tax) as amount')
                ->join('treasury_payee_vouchers', 'treasury_payment_vouchers.id', '=', 'treasury_payee_vouchers.payment_voucher_id')
                ->join('admin_segments', 'admin_segments.id', '=', 'treasury_payment_vouchers.admin_segment_id')
                ->whereNull('company_id')
                ->where('type', AppConstant::VOUCHER_TYPE_NON_PERSONAL_VOUCHER)
                ->groupby('treasury_payment_vouchers.admin_segment_id');

        }

        return $pv->get();

    }


    public function summaryPersonalAdvances($params)
    {


        $pv = PaymentVoucher::query();

        if (isset($params['inputs']['from_date']) && isset($params['inputs']['to_date'])) {
            $fromDate = Carbon::parse($params['inputs']['from_date'])->toDateTimeString();
            $toDate = Carbon::parse($params['inputs']['to_date'])->toDateString() . ' 23:59:59';

            $pv->whereDate('value_date', '>=', $fromDate)
                ->whereDate('value_date', '<=', $toDate);
        }
        if (isset($params['inputs']['admin_segment_id']) && isset($params['inputs']['employee_id'])) {
            $pv->whereHas('payee_vouchers', function ($query) use ($params) {
                $query->where('employee_id', $params['inputs']['employee_id']);
            })
                ->where('admin_segment_id', $params['inputs']['admin_segment_id'])
                ->where('type', AppConstant::VOUCHER_TYPE_PERSONAL_ADVANCES_VOUCHER)
                ->with([
                    'program_segment',
                    'economic_segment',
                    'functional_segment',
                    'geo_code_segment',
                    'admin_segment',
                    'fund_segment',
                    'aie',
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
                ->where('type', AppConstant::VOUCHER_TYPE_PERSONAL_ADVANCES_VOUCHER)
                ->groupby(['admin_segment_id', 'hr_employees.id']);
        } elseif (isset($params['inputs']['admin_segment_ids'])) {
            $adminSegmentData = $this->getAllChildren($params['inputs']['admin_segment_ids']);
            $adminSegmentsIds = [];
            foreach ($adminSegmentData as $segment) {
                $adminSegmentsIds = array_merge($adminSegmentsIds, $segment['child_ids']);
            }

            $pv->selectRaw('admin_segment_id,admin_segments.name,SUM(net_amount+total_tax) as amount')
                ->join('treasury_payee_vouchers', 'treasury_payment_vouchers.id', '=', 'treasury_payee_vouchers.payment_voucher_id')
                ->join('admin_segments', 'admin_segments.id', '=', 'treasury_payment_vouchers.admin_segment_id')
                ->whereNull('company_id')
                ->where('type', AppConstant::VOUCHER_TYPE_PERSONAL_ADVANCES_VOUCHER)
                ->whereIn('admin_segment_id', $adminSegmentsIds)
                ->groupby('treasury_payment_vouchers.admin_segment_id');

        } else {
            $pv->selectRaw('admin_segment_id,admin_segments.name,SUM(net_amount+total_tax) as amount')
                ->join('treasury_payee_vouchers', 'treasury_payment_vouchers.id', '=', 'treasury_payee_vouchers.payment_voucher_id')
                ->join('admin_segments', 'admin_segments.id', '=', 'treasury_payment_vouchers.admin_segment_id')
                ->whereNull('company_id')
                ->where('type', AppConstant::VOUCHER_TYPE_PERSONAL_ADVANCES_VOUCHER)
                ->groupby('treasury_payment_vouchers.admin_segment_id');

        }

        return $pv->get();

    }


    public function summaryStandingImprest($params)
    {

        $pv = PaymentVoucher::query();

        if (isset($params['inputs']['from_date']) && isset($params['inputs']['to_date'])) {
            $fromDate = Carbon::parse($params['inputs']['from_date'])->toDateTimeString();
            $toDate = Carbon::parse($params['inputs']['to_date'])->toDateString() . ' 23:59:59';

            $pv->whereDate('value_date', '>=', $fromDate)
                ->whereDate('value_date', '<=', $toDate);
        }

        if (isset($params['inputs']['admin_segment_id']) && isset($params['inputs']['employee_id'])) {
            $pv->whereHas('payee_vouchers', function ($query) use ($params) {
                $query->where('employee_id', $params['inputs']['employee_id']);
            })
                ->where('admin_segment_id', $params['inputs']['admin_segment_id'])
                ->where('type', AppConstant::VOUCHER_TYPE_STANDING_VOUCHER)
                ->with([
                    'program_segment',
                    'economic_segment',
                    'functional_segment',
                    'geo_code_segment',
                    'admin_segment',
                    'fund_segment',
                    'aie',
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
                ->where('type', AppConstant::VOUCHER_TYPE_STANDING_VOUCHER)
                ->groupby(['admin_segment_id', 'hr_employees.id']);
        } elseif (isset($params['inputs']['admin_segment_ids'])) {
            $adminSegmentData = $this->getAllChildren($params['inputs']['admin_segment_ids']);
            $adminSegmentsIds = [];
            foreach ($adminSegmentData as $segment) {
                $adminSegmentsIds = array_merge($adminSegmentsIds, $segment['child_ids']);
            }

            $pv->selectRaw('admin_segment_id,admin_segments.name,SUM(net_amount+total_tax) as amount')
                ->join('treasury_payee_vouchers', 'treasury_payment_vouchers.id', '=', 'treasury_payee_vouchers.payment_voucher_id')
                ->join('admin_segments', 'admin_segments.id', '=', 'treasury_payment_vouchers.admin_segment_id')
                ->whereNull('company_id')
                ->where('type', AppConstant::VOUCHER_TYPE_STANDING_VOUCHER)
                ->whereIn('admin_segment_id', $adminSegmentsIds)
                ->groupby('treasury_payment_vouchers.admin_segment_id');

        } else {
            $pv->selectRaw('admin_segment_id,admin_segments.name,SUM(net_amount+total_tax) as amount')
                ->join('treasury_payee_vouchers', 'treasury_payment_vouchers.id', '=', 'treasury_payee_vouchers.payment_voucher_id')
                ->join('admin_segments', 'admin_segments.id', '=', 'treasury_payment_vouchers.admin_segment_id')
                ->whereNull('company_id')
                ->where('type', AppConstant::VOUCHER_TYPE_STANDING_VOUCHER)
                ->groupby('treasury_payment_vouchers.admin_segment_id');


        }

        return $pv->get();

    }


    public function summarySpecialImprest($params)
    {

        $pv = PaymentVoucher::query();

        if (isset($params['inputs']['from_date']) && isset($params['inputs']['to_date'])) {
            $fromDate = Carbon::parse($params['inputs']['from_date'])->toDateTimeString();
            $toDate = Carbon::parse($params['inputs']['to_date'])->toDateString() . ' 23:59:59';

            $pv->whereDate('value_date', '>=', $fromDate)
                ->whereDate('value_date', '<=', $toDate);
        }

        if (isset($params['inputs']['admin_segment_id']) && isset($params['inputs']['employee_id'])) {
            $pv->whereHas('payee_vouchers', function ($query) use ($params) {
                $query->where('employee_id', $params['inputs']['employee_id']);
            })
                ->where('admin_segment_id', $params['inputs']['admin_segment_id'])
                ->where('type', AppConstant::VOUCHER_TYPE_SPECIAL_VOUCHER)
                ->with([
                    'program_segment',
                    'economic_segment',
                    'functional_segment',
                    'geo_code_segment',
                    'admin_segment',
                    'fund_segment',
                    'aie',
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
                ->where('type', AppConstant::VOUCHER_TYPE_SPECIAL_VOUCHER)
                ->groupby(['admin_segment_id', 'hr_employees.id']);
        } elseif (isset($params['inputs']['admin_segment_ids'])) {
            $adminSegmentData = $this->getAllChildren($params['inputs']['admin_segment_ids']);
            $adminSegmentsIds = [];
            foreach ($adminSegmentData as $segment) {
                $adminSegmentsIds = array_merge($adminSegmentsIds, $segment['child_ids']);
            }

            $pv->selectRaw('admin_segment_id,admin_segments.name,SUM(net_amount+total_tax) as amount')
                ->join('treasury_payee_vouchers', 'treasury_payment_vouchers.id', '=', 'treasury_payee_vouchers.payment_voucher_id')
                ->join('admin_segments', 'admin_segments.id', '=', 'treasury_payment_vouchers.admin_segment_id')
                ->whereNull('company_id')
                ->where('type', AppConstant::VOUCHER_TYPE_SPECIAL_VOUCHER)
                ->whereIn('admin_segment_id', $adminSegmentsIds)
                ->groupby('treasury_payment_vouchers.admin_segment_id');

        } else {
            $pv->selectRaw('admin_segment_id,admin_segments.name,SUM(net_amount+total_tax) as amount')
                ->join('treasury_payee_vouchers', 'treasury_payment_vouchers.id', '=', 'treasury_payee_vouchers.payment_voucher_id')
                ->join('admin_segments', 'admin_segments.id', '=', 'treasury_payment_vouchers.admin_segment_id')
                ->whereNull('company_id')
                ->where('type', AppConstant::VOUCHER_TYPE_SPECIAL_VOUCHER)
                ->groupby('treasury_payment_vouchers.admin_segment_id');


        }

        return $pv->get();

    }


    public function downloadReportRv($params)
    {
//        $headers = array_combine(json_decode($params['inputs']['columns']), json_decode($params['inputs']['columns']));
        $finalData = [];
        $rvRepo = new ReceiptVoucherRepository();

        $receiptVouchers = $rvRepo->getAll($params)['items'];

        foreach ($receiptVouchers as $key => $receiptVoucher) {
            $headers = [
                "PV Year" => "PV Year",
                "Deptal No." => "Deptal No.",
                "Amount (Net)" => "Amount (Net)",
                "Cashbook" => "Cashbook",
//                "Total Amount" => "Total Amount",
                "Last Actioned" => "Last Actioned",
                "Currency" => "Currency",
                "Value Date" => "Value Date",
                "Type Of Payee" => "Type Of Payee",
                "Xrate" => "Xrate",
                "XRate To USD" => "XRate To USD",
                "Ref. AIE" => "Ref. AIE",
                "Ref. AIE Title" => "Ref. AIE Title",
                "Prepared Date" => "Prepared Date",
                "COA: Admin" => "COA: Admin",
                "COA: Programme" => "COA: Programme",
                "COA: Geo Code" => "COA: Geo Code",
                "COA: Fund" => "COA: Fund",
                "COA: Functional" => "COA: Functional",
                "COA: Economic" => "COA: Economic",
                "Admin FullCode" => "Admin FullCode",
                "Admin: Title" => "Admin: Title",
                "Programme: Title" => "Programme: Title",
                "Programme: Full Code" => "Programme: Full Code",
                "Economic: Full Code" => "Economic: Full Code",
                "Economic: Title" => "Economic: Title",
                "Geo: Title" => "Geo: Title",
                "Geo: Full Code" => "Geo: Full Code",
                "Fund: Title" => "Fund: Title",
                "Fund: Full Code" => "Fund: Full Code",
                "Functional: Title" => "Functional: Title",
                "Functional: Full Code" => "Functional: Full Code",
                "Receiving Officer" => "Receiving Officer",
                "Prepared By Officer" => "Prepared By Officer",
                "Closed By Controller" => "Closed By Controller",
                "Parent Voucher Year" => "Parent Voucher Year",
                "Parent Voucher Ref" => "Parent Voucher Ref",
//                "Checked?" => "Checked?",
//                "Approved?" => "Approved?",
//                "Audited?" => "Audited?",
//                "Paid?" => "Paid?",
//                "Approved Date" => "Approved Date",
//                "Checked Date" => "Checked Date",
//                "Audited Date" => "Audited Date",
//                "Paid Date" => "Paid Date",
                "Status" => "Status"
            ];


            $finalData[] = [''];
            $finalData[] = $headers;


            $data = [
                $receiptVoucher->getYearAttribute(),
                $receiptVoucher->deptal_id,
                $receiptVoucher->total_amount->amount ?? 0,
                $receiptVoucher->cashbook->cashbook_title ?? 0,
//                ($receiptVoucher->total_amount->amount ?? 0) + ($receiptVoucher->total_amount->tax ?? 0),
                Carbon::parse($receiptVoucher->updated_at)->toDateString(),
                $receiptVoucher->cashbook->currency->plural_currency_name ?? null,
                Carbon::parse($receiptVoucher->value_date)->toDateString(),
                $receiptVoucher->type,
                $receiptVoucher->x_rate,
                $receiptVoucher->official_x_rate,
                $receiptVoucher->aie->id ?? null,
                $receiptVoucher->aie->narration ?? null,
                Carbon::parse($receiptVoucher->created_at)->toDateString(),
                $receiptVoucher->admin_segment->id ?? null,
                $receiptVoucher->program_segment->id ?? null,
                $receiptVoucher->geo_code_segment->id ?? null,
                $receiptVoucher->fund_segment->id ?? null,
                $receiptVoucher->functional_segment->id ?? null,
                $receiptVoucher->economic_segment->id ?? null,
                $receiptVoucher->admin_segment->combined_code ?? null,
                $receiptVoucher->admin_segment->name ?? null,
                $receiptVoucher->program_segment->combined_code ?? null,
                $receiptVoucher->program_segment->name ?? null,
                $receiptVoucher->economic_segment->combined_code ?? null,
                $receiptVoucher->economic_segment->name ?? null,
                $receiptVoucher->geo_code_segment->combined_code ?? null,
                $receiptVoucher->geo_code_segment->name ?? null,
                $receiptVoucher->fund_segment->combined_code ?? null,
                $receiptVoucher->fund_segment->name ?? null,
                $receiptVoucher->functional_segment->combined_code ?? null,
                $receiptVoucher->functional_segment->name ?? null,
                ($receiptVoucher->receiving_officer->first_name ?? '') . ' ' . ($receiptVoucher->receiving_officer->last_name ?? ' '),
                ($receiptVoucher->closed_by_officer->first_name ?? '') . ' ' . ($receiptVoucher->closed_by_officer->last_name ?? ''),
                ($receiptVoucher->prepared_by_officer->first_name ?? null) . ' ' . ($receiptVoucher->prepared_by_officer->last_name ?? ''),
                $receiptVoucher->getYearAttribute(),
                $receiptVoucher->id,
//                $receiptVoucher->getIsCheckedAttribute(),
//                $receiptVoucher->getIsApprovedAttribute(),
//                $receiptVoucher->getIsAuditedAttribute(),
//                $receiptVoucher->getIsPayedAttribute(),
//                $receiptVoucher->approved_date ?? null,
//                $receiptVoucher->checked_date ?? null,
//                $receiptVoucher->audited_date ?? null,
//                $receiptVoucher->paid_date ?? null,
                $receiptVoucher->status
            ];
            $finalData[] = $data;

            $headers2 = [
                'Payee Id',
                'Payee Name',
                'Amount',
                'Tax',
                'Payee Bank',
                'Branch'
            ];

            $finalData[] = $headers2;

            if (isset($receiptVoucher->receipt_payees)) {
                foreach ($receiptVoucher->receipt_payees as $payee) {
                    $finalData[] = [
                        $payee->id,
                        ($payee->employee->first_name ?? ' ') . ' ' . ($payee->employee->last_name ?? ' '),
                        $payee->net_amount,
                        $payee->total_tax,
                        $payee->admin_company->company_bank->bank_branch->hr_bank->name ?? null,
                        $payee->admin_company->company_bank->bank_branch->name ?? null
                    ];
                }
            }




            $headers3 = [
                'Schedule Economic Id',
                'Economic Segment Name',
                'Amount'
            ];

            $finalData[] = $headers3;

            /** @var ReceiptScheduleEconomic $schedule */

            if (isset($receiptVoucher->receipt_schedule_economic)) {
                foreach ($receiptVoucher->receipt_schedule_economic as $schedule) {
                    $finalData[] = [
                        $schedule->id,
                        $schedule->admin_segment->name ?? null,
                        $schedule->amount
                    ];
                }
            }


            $finalData[] = ['', ''];
        }

        $filePath = 'csv/receipt_voucher' . \Carbon\Carbon::now()->format("Y-m-d_h:i:s") . '.xlsx';
        UtilityService::createSpoutFile($finalData, [], $filePath);

        return ['url' => url($filePath)];
    }

    public function downloadReportPv($params)
    {
        $pvRepo = new PaymentRepository();
        $finalData = [];
        $paymentVouchers = $pvRepo->getAll($params)['items'];

        foreach ($paymentVouchers as $key => $paymentVoucher) {
            $headers = [
                "PV Year" => "PV Year",
                "Deptal No." => "Deptal No.",
                "Amount (Net)" => "Amount (Net)",
                "Taxes" => "Taxes",
                "Total Amount" => "Total Amount",
                "Last Actioned" => "Last Actioned",
                "Currency" => "Currency",
                "Value Date" => "Value Date",
                "Type Of Payee" => "Type Of Payee",
                "Xrate" => "Xrate",
                "XRate To USD" => "XRate To USD",
                "Ref. AIE" => "Ref. AIE",
                "Ref. AIE Title" => "Ref. AIE Title",
                "Prepared Date" => "Prepared Date",
                "COA: Admin" => "COA: Admin",
                "COA: Programme" => "COA: Programme",
                "COA: Geo Code" => "COA: Geo Code",
                "COA: Fund" => "COA: Fund",
                "COA: Functional" => "COA: Functional",
                "COA: Economic" => "COA: Economic",
                "Admin FullCode" => "Admin FullCode",
                "Admin: Title" => "Admin: Title",
                "Programme: Title" => "Programme: Title",
                "Programme: Full Code" => "Programme: Full Code",
                "Economic: Full Code" => "Economic: Full Code",
                "Economic: Title" => "Economic: Title",
                "Geo: Title" => "Geo: Title",
                "Geo: Full Code" => "Geo: Full Code",
                "Fund: Title" => "Fund: Title",
                "Fund: Full Code" => "Fund: Full Code",
                "Functional: Title" => "Functional: Title",
                "Functional: Full Code" => "Functional: Full Code",
                "Checking Officer" => "Checking Officer",
                "Paying Officer" => "Paying Officer",
                "Financials Controller" => "Financials Controller",
                "Parent Voucher Year" => "Parent Voucher Year",
                "Parent Voucher Ref" => "Parent Voucher Ref",
                "Checked?" => "Checked?",
                "Approved?" => "Approved?",
                "Audited?" => "Audited?",
                "Paid?" => "Paid?",
                "Approved Date" => "Approved Date",
                "Checked Date" => "Checked Date",
                "Audited Date" => "Audited Date",
                "Paid Date" => "Paid Date",
                "Status" => "Status"
            ];


            $finalData[] = [''];
            $finalData[] = $headers;

            $data = [
                $paymentVoucher->getYearAttribute(),
                $paymentVoucher->deptal_id,
                $paymentVoucher->total_amount->amount ?? 0,
                $paymentVoucher->total_tax->tax ?? 0,
                ($paymentVoucher->total_amount->amount ?? 0) + ($paymentVoucher->total_amount->tax ?? 0),
                Carbon::parse($paymentVoucher->updated_at)->toDateString(),
                $paymentVoucher->currency->plural_currency_name ?? null,
                Carbon::parse($paymentVoucher->value_date)->toDateString(),
                $paymentVoucher->type,
                $paymentVoucher->x_rate,
                $paymentVoucher->official_x_rate,
                $paymentVoucher->aie->id ?? null,
                $paymentVoucher->aie->narration ?? null,
                Carbon::parse($paymentVoucher->created_at)->toDateString(),
                $paymentVoucher->admin_segment->id ?? null,
                $paymentVoucher->program_segment->id ?? null,
                $paymentVoucher->geo_code_segment->id ?? null,
                $paymentVoucher->fund_segment->id ?? null,
                $paymentVoucher->functional_segment->id ?? null,
                $paymentVoucher->economic_segment->id ?? null,
                $paymentVoucher->admin_segment->combined_code ?? null,
                $paymentVoucher->admin_segment->name ?? null,
                $paymentVoucher->program_segment->combined_code ?? null,
                $paymentVoucher->program_segment->name ?? null,
                $paymentVoucher->economic_segment->combined_code ?? null,
                $paymentVoucher->economic_segment->name ?? null,
                $paymentVoucher->geo_code_segment->combined_code ?? null,
                $paymentVoucher->geo_code_segment->name ?? null,
                $paymentVoucher->fund_segment->combined_code ?? null,
                $paymentVoucher->fund_segment->name ?? null,
                $paymentVoucher->functional_segment->combined_code ?? null,
                $paymentVoucher->functional_segment->name ?? null,
                $paymentVoucher->checking_officer->first_name . ' ' . $paymentVoucher->checking_officer->last_name,
                $paymentVoucher->paying_officer->first_name . ' ' . $paymentVoucher->paying_officer->last_name,
                $paymentVoucher->financial_controller->first_name . ' ' . $paymentVoucher->financial_controller->last_name,
                $paymentVoucher->getYearAttribute(),
                $paymentVoucher->id,
                $paymentVoucher->getIsCheckedAttribute(),
                $paymentVoucher->getIsApprovedAttribute(),
                $paymentVoucher->getIsAuditedAttribute(),
                $paymentVoucher->getIsPayedAttribute(),
                $paymentVoucher->approved_date ?? null,
                $paymentVoucher->checked_date ?? null,
                $paymentVoucher->audited_date ?? null,
                $paymentVoucher->paid_date ?? null,
                $paymentVoucher->status
            ];

            $finalData[] = $data;

            $headers2 = [
                'Payee Id',
                'Payee Name',
                'Amount',
                'Tax',
                'Payee Bank',
                'Branch'
            ];

            $finalData[] = $headers2;

            foreach ($paymentVoucher->payee_vouchers as $payee) {
                $finalData[] = [
                    $payee->id,
                    ($payee->employee->first_name ?? ' ') . ' ' . ($payee->employee->last_name ?? ' '),
                    $payee->net_amount,
                    $payee->total_tax,
                    $payee->admin_company->company_bank->bank_branch->hr_bank->name ?? null,
                    $payee->admin_company->company_bank->bank_branch->name ?? null
                ];

            }

            $headers3 = [
                'Schedule Economic Id',
                'Economic Segment Name',
                'Amount'
            ];

            $finalData[] = $headers3;

            foreach ($paymentVoucher->schedule_economic as $schedule) {
                $finalData[] = [
                    $schedule->id,
                    $schedule->admin_segment->name ?? null,
                    $schedule->amount
                ];
            }

            $finalData[] = ['', ''];
        }

        $filePath = 'csv/payment_voucher' . \Carbon\Carbon::now()->format("Y-m-d_h:i:s") . '.xlsx';
        UtilityService::createSpoutFile($finalData, [], $filePath);

        return ['url' => url($filePath)];
    }

}



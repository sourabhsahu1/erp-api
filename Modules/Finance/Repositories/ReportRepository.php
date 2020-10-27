<?php


namespace Modules\Finance\Repositories;


use Carbon\Carbon;
use http\Env\Request;
use Illuminate\Support\Facades\DB;
use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Admin\Models\AdminSegment;
use Modules\Finance\Models\JournalVoucher;
use Modules\Finance\Models\JvTrailBalanceReport;
use Modules\Finance\Models\NotesTrailBalanceReport;

class ReportRepository extends EloquentBaseRepository
{

    public $model = JournalVoucher::class;


    public function getTrialBalanceReport($params)
    {

        $economicSegmentChildIds = AdminSegment::where('parent_id', 2)->get()->pluck('id');

        $journals = JvTrailBalanceReport::with(['economic_segment', 'parent']);

        if (!isset($params['inputs']['parent_id'])) {
            $journals->whereIn('economic_segment_id', $economicSegmentChildIds);
        }

        if (isset($params['inputs']['parent_id'])) {
            $journals->where('parent_id', $params['inputs']['parent_id']);
        }

        if (isset($params['inputs']['from_date']) && isset($params['inputs']['to_date'])) {
            $fromDate = $params['inputs']['from_date'] . ' 00:00:00';
            $toDate = $params['inputs']['to_date'] . ' 23:59:59';
            $journals->where('created_at', '>=', $fromDate)
                ->where('created_at', '<=', $toDate);
        }
        $params['inputs']['orderby'] = 'created_at';
        return parent::getAll($params, $journals);
    }

    public function getJvLedgerReport($params)
    {
        $query = JournalVoucher
            ::join('journal_voucher_details as jd', 'journal_vouchers.id', '=', 'jd.journal_voucher_id');

        if (isset($params['inputs']['programme_segment_id'])) {
            $query->where('jd.programme_segment_id', $params['inputs']['programme_segment_id']);
        }

        if (isset($params['inputs']['economic_segment_id'])) {
            $query->where('jd.economic_segment_id', $params['inputs']['economic_segment_id']);
        }
        return parent::getAll($params, $query);
    }


    public function addNotes($data)
    {

        $jvTbReport = JvTrailBalanceReport::where('economic_segment_id', $data['data']['economic_segment_id'])->orWhere('parent_id', $data['data']['economic_segment_id'])->get();


        $checkForJv = JvTrailBalanceReport::where('parent_id', $data['data']['economic_segment_id'])->get();

        if ($checkForJv->isEmpty()) {
            throw new AppException('child doesnt exist , cannot create notes');
        }

        $d = [];
        foreach ($jvTbReport as $item) {
            $parent = false;
            if ($item->economic_segment_id == $data['data']['economic_segment_id']) {
                $parent = true;
            }
            $d[] = [
                'jv_tb_report_id' => $item->id,
                'is_parent' => $parent
            ];
        }
        DB::beginTransaction();
        try {
            if (count($d) > 0) {
                NotesTrailBalanceReport::insert($d);
            }

            $jv = JvTrailBalanceReport::rightjoin('notes_trail_balance_report as n', 'jv_trail_balance_report.id', '=', 'n.jv_tb_report_id')->where('economic_segment_id', $data['data']['economic_segment_id'])->first();

            JvTrailBalanceReport::where('economic_segment_id', $data['data']['economic_segment_id'])->update(['note_id' => $jv->id]);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        $jv = JvTrailBalanceReport::rightjoin('notes_trail_balance_report as n', 'jv_trail_balance_report.id', '=', 'n.jv_tb_report_id')->where('economic_segment_id', $data['data']['economic_segment_id'])->first();

        return $jv;
    }


    public function getNotesTrialBalanceReport($params)
    {
        $jv = JvTrailBalanceReport::with(['economic_segment', 'parent'])->join('notes_trail_balance_report as n', 'jv_trail_balance_report.id', '=', 'n.jv_tb_report_id');

        if (!isset($params['inputs']['parent_id'])) {
            $jv->where('n.is_parent', 1);
        }

        if (isset($params['inputs']['parent_id'])) {
            $jv->where('jv_trail_balance_report.parent_id', $params['inputs']['parent_id'])
                ->where('n.is_parent', 0);
        }

        $params['inputs']['orderby'] = 'n.created_at';
        return parent::getAll($params, $jv);

    }

    public function getSiblingReport($params)
    {
        $query = JournalVoucher
            ::join('journal_voucher_details as jd', 'journal_vouchers.id', '=', 'jd.journal_voucher_id');

        if (isset($params['inputs']['programme_segment_id'])) {
            $query->where('jd.programme_segment_id', $params['inputs']['programme_segment_id']);
        }

        if (isset($params['inputs']['economic_segment_id'])) {
            $query->where('jd.economic_segment_id', $params['inputs']['economic_segment_id']);
        }

        if (isset($params['inputs']['journal_voucher_id']) && isset($params['inputs']['jv_detail_id'])) {
            $query->where('journal_voucher_id', $params['inputs']['journal_voucher_id'])
            ->where('jd.id', '!=',$params['inputs']['jv_detail_id']);
        }

        return parent::getAll($params, $query);
    }


    public function getMonthlyActivity($params)
    {


        $jvS = AdminSegment::join('journal_voucher_details as jd', 'admin_segments.id', '=', 'jd.economic_segment_id')
            ->selectRaw('name,jd.economic_segment_id, month(jd.created_at) as month, sum(lv_line_value) sum, line_value_type')
            ->groupby(DB::raw('name,jd.economic_segment_id, month(jd.created_at), line_value_type'))
            ->get()->toArray();

        $data = null;
        foreach ($jvS as $jv) {
            if (!isset($data[$jv['economic_segment_id'] . '_' . $jv['month']])) {
                $data[$jv['economic_segment_id'] . '_' . $jv['month']]['balance'] = 0;
            }
            $data[$jv['economic_segment_id'] . '_' . $jv['month']] = [
                'name' => $jv['name'],
                'economic_segment_id' => $jv['economic_segment_id'],
                'month' => $jv['month'],
                'balance' => ($jv['line_value_type'] === 'CREDIT') ? $data[$jv['economic_segment_id'] . '_' . $jv['month']]['balance'] + $jv['sum'] : $data[$jv['economic_segment_id'] . '_' . $jv['month']]['balance'] - $jv['sum']
            ];
        }

        $d = [];
        foreach ($data as $item) {
            if (isset($d[$item['economic_segment_id']])) {
                $d[$item['economic_segment_id']]['month' . $item['month']] += $item['balance'];
            } else {
                $d[$item['economic_segment_id']] = [
                    'name' => $item['name'],
                    'economic_segment_id' => $item['economic_segment_id'],
                    'month1' => 0, 'month2' => 0, 'month3' => 0, 'month4' => 0,
                    'month5' => 0, 'month6' => 0, 'month7' => 0, 'month8' => 0,
                    'month9' => 0, 'month10' => 0, 'month11' => 0, 'month12' => 0,
                ];

                $d[$item['economic_segment_id']]['month' . $item['month']] += $item['balance'];
            }
        }

        $segments = AdminSegment::with('children');

        if (isset($params['inputs']['parent_id'])) {
            $segments->where('parent_id', $params['inputs']['parent_id']);
        } else {
            $segments->where('parent_id', 2);
        }

        $segments = $segments->get()->toArray();

        foreach ($segments as &$segment) {
            $segment['child_ids'] = [];
            $this->getChildIds($segment, $segment);
            unset($segment['children']);

            for ($i = 1; $i < 13; $i++) {
                $segment['month' . $i] = 0;
            }
            foreach ($d as $key => $values) {
                if (array_search($key, $segment['child_ids']) !== false) {
                    $segment['month1'] += $values['month1'];
                    $segment['month2'] += $values['month2'];
                    $segment['month3'] += $values['month3'];
                    $segment['month4'] += $values['month4'];
                    $segment['month5'] += $values['month5'];
                    $segment['month6'] += $values['month6'];
                    $segment['month7'] += $values['month7'];
                    $segment['month8'] += $values['month8'];
                    $segment['month9'] += $values['month9'];
                    $segment['month10'] += $values['month10'];
                    $segment['month11'] += $values['month11'];
                    $segment['month12'] += $values['month12'];

                    unset($d[$key]);
                }
            }
        }

        return ['items' => $segments];
    }

    private function getChildIds($data, &$segment)
    {
        $segment['child_ids'][] = $data['id'];

        foreach ($data['children'] as $child) {
            $this->getChildIds($child, $segment);
        }

    }


    public function getFinancialPerformance($params)
    {


        $jvS = AdminSegment::join('journal_voucher_details as jd', 'admin_segments.id', '=', 'jd.economic_segment_id')
            ->selectRaw('name,jd.economic_segment_id, sum(lv_line_value) sum, line_value_type')
            ->groupby(DB::raw('name,jd.economic_segment_id, line_value_type'))
            ->get()->toArray();

        $data = null;
        foreach ($jvS as $jv) {
            if (!isset($data[$jv['economic_segment_id']])) {
                $data[$jv['economic_segment_id']]['balance'] = 0;
            }
            $data[$jv['economic_segment_id']] = [
                'name' => $jv['name'],
                'economic_segment_id' => $jv['economic_segment_id'],
                'balance' => ($jv['line_value_type'] === 'CREDIT') ? $data[$jv['economic_segment_id']]['balance'] + $jv['sum'] : $data[$jv['economic_segment_id']]['balance'] - $jv['sum']
            ];
        }


        $d = [];
        foreach ($data as $item) {
            if (isset($d[$item['economic_segment_id']])) {
                $d[$item['economic_segment_id']]['month' . $item['month']] += $item['balance'];
            } else {
                $d[$item['economic_segment_id']] = [
                    'name' => $item['name'],
                    'economic_segment_id' => $item['economic_segment_id'],
                    'sum' => 0
                ];

                $d[$item['economic_segment_id']]['month' . $item['month']] += $item['balance'];
            }
        }

        $segments = AdminSegment::with('children');

        if (isset($params['inputs']['parent_id'])) {
            $segments->where('parent_id', $params['inputs']['parent_id']);
        } else {
            $segments->where('parent_id', 2);
        }

        $segments = $segments->get()->toArray();

        foreach ($segments as &$segment) {
            $segment['child_ids'] = [];
            $this->getChildIds($segment, $segment);
            unset($segment['children']);

            for ($i = 1; $i < 13; $i++) {
                $segment['month' . $i] = 0;
            }
            foreach ($d as $key => $values) {
                if (array_search($key, $segment['child_ids']) !== false) {
                    $segment['month1'] += $values['month1'];
                    $segment['month2'] += $values['month2'];
                    $segment['month3'] += $values['month3'];
                    $segment['month4'] += $values['month4'];
                    $segment['month5'] += $values['month5'];
                    $segment['month6'] += $values['month6'];
                    $segment['month7'] += $values['month7'];
                    $segment['month8'] += $values['month8'];
                    $segment['month9'] += $values['month9'];
                    $segment['month10'] += $values['month10'];
                    $segment['month11'] += $values['month11'];
                    $segment['month12'] += $values['month12'];

                    unset($d[$key]);
                }
            }
        }

        return ['items' => $segments];


//        $data['revenue'] = [
//            'combined_code' => 1,
//            'individual_code' => 1,
//            'name' => 'Revenue',
//            'balance' => 20000.00
//        ];
//
//
//        $data['expenditure'] = [
//            'combined_code' => 1,
//            'individual_code' => 1,
//            'name' => 'expenditure',
//            'balance' => 20000.00
//        ];
//
//        $data['revenue']['revenue_child'] = [
//            [
//                'combined_code' => 101,
//                'individual_code' => 1,
//                'name' => 'Govt. share',
//                'balance' => 20000.00
//            ],
//            [
//                'combined_code' => 102,
//                'individual_code' => 2,
//                'name' => 'Independent. share',
//                'balance' => 0.00
//            ],
//            [
//                'combined_code' => 103,
//                'individual_code' => 3,
//                'name' => 'Aid. share',
//                'balance' => '(20000.00)'
//            ],
//            [
//                'combined_code' => 104,
//                'individual_code' => 4,
//                'name' => 'Capital. share',
//                'balance' => 0.00
//            ]
//        ];
//
//        $data['expenditure']['expenditure_child'] = [
//            [
//                'combined_code' => 201,
//                'individual_code' => 1,
//                'name' => 'other. share',
//                'balance' => 0.00
//            ],
//            [
//                'combined_code' => 202,
//                'individual_code' => 2,
//                'name' => 'capital expenditure',
//                'balance' => 0.00
//            ],
//            [
//                'combined_code' => 203,
//                'individual_code' => 3,
//                'name' => 'depreciation',
//                'balance' => 0.00
//            ],
//            [
//                'combined_code' => 204,
//                'individual_code' => 4,
//                'name' => 'impairment charges',
//                'balance' => 0.00
//            ]
//        ];


        return $data;
    }

    public function getStatementOfPosition($params)
    {
        $data['asset'] = [
            'combined_code' => 3,
            'individual_code' => 3,
            'name' => 'Asset',
            'balance' => 20000.00
        ];


        $data['liabilities'] = [
            'combined_code' => 4,
            'individual_code' => 4,
            'name' => 'Liabilities',
            'balance' => 20000.00
        ];

        $data['asset']['asset_child'] = [
            [
                'combined_code' => 301,
                'individual_code' => 1,
                'name' => 'Govt. share',
                'balance' => 20000.00
            ],
            [
                'combined_code' => 302,
                'individual_code' => 2,
                'name' => 'Independent. share',
                'balance' => 0.00
            ],
            [
                'combined_code' => 303,
                'individual_code' => 3,
                'name' => 'Aid. share',
                'balance' => '(20000.00)'
            ],
            [
                'combined_code' => 304,
                'individual_code' => 4,
                'name' => 'Capital. share',
                'balance' => 0.00
            ]
        ];

        $data['liabilities']['liabilities_child'] = [
            [
                'combined_code' => 401,
                'individual_code' => 1,
                'name' => 'other. share',
                'balance' => 0.00
            ],
            [
                'combined_code' => 402,
                'individual_code' => 2,
                'name' => 'capital expenditure',
                'balance' => 0.00
            ],
            [
                'combined_code' => 403,
                'individual_code' => 3,
                'name' => 'depreciation',
                'balance' => 0.00
            ],
            [
                'combined_code' => 404,
                'individual_code' => 4,
                'name' => 'impairment charges',
                'balance' => 0.00
            ]
        ];


        return $data;
    }
}

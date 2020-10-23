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
        if (isset($params['inputs']['economic_segment_id'])) {
            $query = JournalVoucher::with('journal_voucher_details');

            $query->whereHas('journal_voucher_details', function ($query) use ($params) {
                $query->where('economic_segment_id', $params['inputs']['economic_segment_id']);
            });
        } else {
            throw new AppException('Economic Segment id required');
        }
        return parent::getAll($params, $query);
    }


    public function getMonthlyActivity($params)
    {
//        $ad = AdminSegment::with('economic_children');
//        if (isset($params['inputs']['parent_id'])) {
//            $ad->where('id', $params['inputs']['parent_id']);
//        } else {
//            $ad->where('id', 2);
//        }
////        $params['inputs']['orderby'] = 'created_at';
////        $jvResult = parent::getAll($params, $ad);
//
//
////        return $jvResult['items']->toArray();
////        dd($jvResult['items'][0]->toArray());
//
//        dd($ad->get()->toArray());
//
//        foreach ($jvResult['items'][0]->toArray()['economic_children'] as $item) {
//            $parentNode = $item['economic_children'];
//            if (!empty($parentNode['economic_children'])) {
//                $parentNode = $parentNode['economic_children'];
//                dd($parentNode);
//
//                while (!empty($parentNode['economic_children'])) {
//                    $parentNode = $parentNode['economic_children']->toArray();
//                }
//                dd($parentNode);
//            }
//
//
//        }


        $data['revenue'] = [
            [
                'name' => 'Current Assets',
                'combined_code' => 31,
                'jan' => 0,
                'feb' => 0,
                'mar' => 0,
                'apr' => 0,
                'may' => 100,
                'june' => 0,
                'july' => 0,
                'aug' => 200,
                'sept' => 0,
                'nov' => 0,
                'dec' => 0,
            ],
            [
                'name' => 'Non-Current Assets',
                'combined_code' => 32,
                'jan' => 0,
                'feb' => 0,
                'mar' => 0,
                'apr' => 0,
                'may' => 0,
                'june' => 0,
                'july' => 0,
                'aug' => 100,
                'sept' => 0,
                'nov' => 0,
                'dec' => 0,
            ], [
                'name' => 'Intangible Assets',
                'combined_code' => 33,
                'jan' => 0,
                'feb' => 0,
                'mar' => 0,
                'apr' => 0,
                'may' => 0,
                'june' => 0,
                'july' => 0,
                'aug' => 0,
                'sept' => 0,
                'nov' => 0,
                'dec' => 1000,
            ]
        ];
        return $data;
    }


    public function getFinancialPerformance($params)
    {


        $data['revenue'] = [
            'combined_code' => 1,
            'individual_code' => 1,
            'name' => 'Revenue',
            'balance' => 20000.00
        ];


        $data['expenditure'] = [
            'combined_code' => 1,
            'individual_code' => 1,
            'name' => 'expenditure',
            'balance' => 20000.00
        ];

        $data['revenue']['revenue_child'] = [
            [
                'combined_code' => 101,
                'individual_code' => 1,
                'name' => 'Govt. share',
                'balance' => 20000.00
            ],
            [
                'combined_code' => 102,
                'individual_code' => 2,
                'name' => 'Independent. share',
                'balance' => 0.00
            ],
            [
                'combined_code' => 103,
                'individual_code' => 3,
                'name' => 'Aid. share',
                'balance' => '(20000.00)'
            ],
            [
                'combined_code' => 104,
                'individual_code' => 4,
                'name' => 'Capital. share',
                'balance' => 0.00
            ]
        ];

        $data['expenditure']['expenditure_child'] = [
            [
                'combined_code' => 201,
                'individual_code' => 1,
                'name' => 'other. share',
                'balance' => 0.00
            ],
            [
                'combined_code' => 202,
                'individual_code' => 2,
                'name' => 'capital expenditure',
                'balance' => 0.00
            ],
            [
                'combined_code' => 203,
                'individual_code' => 3,
                'name' => 'depreciation',
                'balance' => 0.00
            ],
            [
                'combined_code' => 204,
                'individual_code' => 4,
                'name' => 'impairment charges',
                'balance' => 0.00
            ]
        ];


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

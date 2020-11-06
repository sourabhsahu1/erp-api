<?php


namespace Modules\Finance\Repositories;


use App\Constants\AppConstant;
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

        $segments = AdminSegment::with('children');
        $economicChilds = AdminSegment::where('parent_id', 2)->get()->pluck('id');

        if (isset($params['inputs']['parent_id'])) {
            $segments->where('parent_id', $params['inputs']['parent_id']);
        } else {
            $segments->whereIn('id', $economicChilds);
        }

        $segments = $segments->get()->toArray();
        $childIds = [];

        foreach ($segments as &$segment) {
            $segment['child_ids'] = [];
            $segment['balance'] = 0;
            $segment['debit'] = 0;
            $segment['credit'] = 0;
            $segment['child_ids'] = $this->getChildIds($segment);
            $childIds = array_merge($childIds, $segment['child_ids']);
            unset($segment['children']);
        }

        $jvS = AdminSegment::join('journal_voucher_details as jd', 'admin_segments.id', '=', 'jd.economic_segment_id')
            ->join('journal_vouchers as jv', 'jv.id', '=', 'jd.journal_voucher_id')
            ->selectRaw('name, jd.economic_segment_id, sum(lv_line_value) sum, line_value_type')
            ->whereIn('admin_segments.id', $childIds)
            ->where('jv.status', AppConstant::JV_STATUS_POSTED)
            ->groupby(DB::raw('name,jd.economic_segment_id, line_value_type'));

        if (isset($params['inputs']['from_date']) && isset($params['inputs']['to_date'])) {
            $fromDate = $params['inputs']['from_date'] . ' 00:00:00';
            $toDate = $params['inputs']['to_date'] . ' 23:59:59';
            $jvS->where('jd.created_at', '>=', $fromDate)
                ->where('jd.created_at', '<=', $toDate);
        }

        $jvS = $jvS->get()->toArray();

        foreach ($jvS as $jv) {
            foreach ($segments as &$segment) {
                if (array_search($jv['economic_segment_id'], $segment['child_ids']) !== false) {

                    $segment['balance'] += $jv['sum'];
                    if ($jv['line_value_type'] == 'CREDIT') {
                        $segment['credit'] += $jv['sum'];
                    } else {
                        $segment['debit'] += $jv['sum'];
                    }
                    break;
                }
            }
        }

        return ['items' => $segments];

//        $economicSegmentChildIds = AdminSegment::where('parent_id', 2)->get()->pluck('id');
//
//        $journals = JvTrailBalanceReport::with(['economic_segment', 'parent']);
//
//        if (!isset($params['inputs']['parent_id'])) {
//            $journals->whereIn('economic_segment_id', $economicSegmentChildIds);
//        }
//
//        if (isset($params['inputs']['parent_id'])) {
//            $journals->where('parent_id', $params['inputs']['parent_id']);
//        }
//
//        if (isset($params['inputs']['from_date']) && isset($params['inputs']['to_date'])) {
//            $fromDate = $params['inputs']['from_date'] . ' 00:00:00';
//            $toDate = $params['inputs']['to_date'] . ' 23:59:59';
//            $journals->where('created_at', '>=', $fromDate)
//                ->where('created_at', '<=', $toDate);
//        }
//        $params['inputs']['orderby'] = 'created_at';
//        return parent::getAll($params, $journals);
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
            ::join('journal_voucher_details as jd', 'journal_vouchers.id', '=', 'jd.journal_voucher_id')
            ->join('admin_segments', 'jd.economic_segment_id', '=', 'admin_segments.id')
            ->where('status', AppConstant::JV_STATUS_POSTED);

        $q = clone $query;
        if (isset($params['inputs']['economic_segment_id'])) {
            $query->where('jd.economic_segment_id', $params['inputs']['economic_segment_id']);
        }

        if (isset($params['inputs']['journal_voucher_id']) && isset($params['inputs']['jv_detail_id'])) {
            $q->where('journal_voucher_id', $params['inputs']['journal_voucher_id'])
                ->where('jd.id', '!=', $params['inputs']['jv_detail_id']);
            return parent::getAll($params, $q);
        }

        return parent::getAll($params, $query);
    }

    public function getMonthlyActivity($params)
    {


        $jvS = AdminSegment::join('journal_voucher_details as jd', 'admin_segments.id', '=', 'jd.economic_segment_id')
            ->join('journal_vouchers as jv', 'jv.id', '=', 'jd.journal_voucher_id')
            ->selectRaw('name,jd.economic_segment_id, month(jd.created_at) as month, sum(lv_line_value) sum, line_value_type')
//            ->where('jv.status', AppConstant::JV_STATUS_POSTED)
            ->groupby(DB::raw('name,jd.economic_segment_id, month(jd.created_at), line_value_type'))
            ->get()
            ->toArray();

        $data = null;
        $d = [];

        foreach ($jvS as $item) {
            if (isset($d[$item['economic_segment_id']])) {
                if ($item['line_value_type'] === 'CREDIT') {
                    $d[$item['economic_segment_id']]['month' . $item['month']] += $item['sum'];
                } else {
                    $d[$item['economic_segment_id']]['month' . $item['month']] -= $item['sum'];
                }
            } else {
                $d[$item['economic_segment_id']] = [
                    'name' => $item['name'],
                    'economic_segment_id' => $item['economic_segment_id'],
                    'month1' => 0, 'month2' => 0, 'month3' => 0, 'month4' => 0,
                    'month5' => 0, 'month6' => 0, 'month7' => 0, 'month8' => 0,
                    'month9' => 0, 'month10' => 0, 'month11' => 0, 'month12' => 0,
                ];
                if ($item['line_value_type'] === 'CREDIT') {
                    $d[$item['economic_segment_id']]['month' . $item['month']] += $item['sum'];
                } else {
                    $d[$item['economic_segment_id']]['month' . $item['month']] -= $item['sum'];
                }
            }
        }

        $segments = AdminSegment::with('children');

        if (isset($params['inputs']['parent_id'])) {
            $segments->where('parent_id', $params['inputs']['parent_id']);
        } elseif (isset($params['inputs']['economic_segment_id'])) {
            $segments->where('id', $params['inputs']['economic_segment_id']);
        } else {
            $segments->where('parent_id', 2);
        }

        $segments = $segments->get()->toArray();

        foreach ($segments as &$segment) {
            $segment['child_ids'] = [];
            $childIds = $this->getChildIds($segment);
            $segment['child_ids'] = $childIds;
//            unset($segment['children']);

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

    private function getChildIds(&$data)
    {
        $childIds = [];
        $childIds[] = $data['id'];

        foreach ($data['children'] as &$child) {
            $child['child_ids'] = $this->getChildIds($child);
            $child['month1'] = 0;
            $child['month2'] = 0;
            $child['month3'] = 0;
            $child['month4'] = 0;
            $child['month5'] = 0;
            $child['month6'] = 0;
            $child['month7'] = 0;
            $child['month8'] = 0;
            $child['month9'] = 0;
            $child['month10'] = 0;
            $child['month11'] = 0;
            $child['month12'] = 0;
            $childIds = array_merge($childIds, $child['child_ids']);
        }

        return $childIds;
    }

    public function getFinancialPerformance($params)
    {
        $segments = AdminSegment::with('children');

        if (isset($params['inputs']['parent_id'])) {
            $segments->where('parent_id', $params['inputs']['parent_id']);
        } else {
            $segments->whereIn('id', [7, 8]);
        }

        $segments = $segments->get()->toArray();
        $childIds = [];

        foreach ($segments as &$segment) {
            $segment['child_ids'] = [];
            $segment['balance'] = 0;
            $segment['child_ids'] = $this->getChildIds($segment);
            $childIds = array_merge($childIds, $segment['child_ids']);
            unset($segment['children']);
        }

        $jvS = AdminSegment::join('journal_voucher_details as jd', 'admin_segments.id', '=', 'jd.economic_segment_id')
            ->join('journal_vouchers as jv', 'jv.id', '=', 'jd.journal_voucher_id')
            ->selectRaw('name, jd.economic_segment_id, sum(lv_line_value) sum, line_value_type')
            ->whereIn('admin_segments.id', $childIds)
            ->where('jv.status', AppConstant::JV_STATUS_POSTED)
            ->groupby(DB::raw('name,jd.economic_segment_id, line_value_type'))
            ->get()
            ->toArray();

        foreach ($jvS as $jv) {
            foreach ($segments as &$segment) {
                if (array_search($jv['economic_segment_id'], $segment['child_ids']) !== false) {
                    $segment['balance'] += $jv['sum'];
                    break;
                }
            }
        }

        return ['items' => $segments];
    }

    public function getStatementOfPosition($params)
    {
        $segments = AdminSegment::with('children');

        if (isset($params['inputs']['parent_id'])) {
            $segments->where('parent_id', $params['inputs']['parent_id']);
        } else {
            $segments->whereIn('id', [9, 10]);
        }

        $segments = $segments->get()->toArray();
        $childIds = [];

        foreach ($segments as &$segment) {
            $segment['child_ids'] = [];
            $segment['balance'] = 0;
            $segment['child_ids'] = $this->getChildIds($segment);
            $childIds = array_merge($childIds, $segment['child_ids']);
            unset($segment['children']);
        }

        $jvS = AdminSegment::join('journal_voucher_details as jd', 'admin_segments.id', '=', 'jd.economic_segment_id')
            ->join('journal_vouchers as jv', 'jv.id', '=', 'jd.journal_voucher_id')
            ->selectRaw('name, jd.economic_segment_id, sum(lv_line_value) sum, line_value_type')
            ->whereIn('admin_segments.id', $childIds)
            ->where('jv.status', AppConstant::JV_STATUS_POSTED)
            ->groupby(DB::raw('name,jd.economic_segment_id, line_value_type'))
            ->get()
            ->toArray();

        foreach ($jvS as $jv) {
            foreach ($segments as &$segment) {
                if (array_search($jv['economic_segment_id'], $segment['child_ids']) !== false) {
                    $segment['balance'] += $jv['sum'];
                    break;
                }
            }
        }

        return ['items' => $segments];
    }
}

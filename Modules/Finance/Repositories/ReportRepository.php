<?php


namespace Modules\Finance\Repositories;


use Carbon\Carbon;
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

        NotesTrailBalanceReport::insert($d);

        return ['data' => 'success'];
    }



    public function getNotesTrialBalanceReport($params) {
        $jv = JvTrailBalanceReport::join('notes_trail_balance_report as n','jv_trail_balance_report.id','=','n.jv_tb_report_id');

        if (!isset($params['inputs']['parent_id'])) {
            $jv->where('n.is_parent', 1);
        }

        if (isset($params['inputs']['parent_id'])) {
//            dd($jv->get()->toArray());
            $jv->where('jv_trail_balance_report.parent_id', $params['inputs']['parent_id'])
            ->where('n.is_parent', 0);
        }



        $params['inputs']['orderby'] = 'n.created_at';
        return parent::getAll($params, $jv);

    }
}

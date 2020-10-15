<?php


namespace Modules\Finance\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Admin\Models\AdminSegment;
use Modules\Finance\Models\JournalVoucher;
use Modules\Finance\Models\JvTrailBalanceReport;

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
}

<?php


namespace Modules\Finance\Repositories;


use App\Constants\AppConstant;
use Illuminate\Support\Facades\DB;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Admin\Models\AdminSegment;
use Modules\Finance\Models\JournalVoucher;

class ReportRepository extends EloquentBaseRepository
{

    public $model = JournalVoucher::class;


    public function getTrialBalanceReport($params)
    {

        $journals = DB::table('journal_vouchers as j')
            ->join('journal_voucher_details as jd', 'j.id', '=', 'jd.journal_voucher_id')
            ->where('j.status', AppConstant::JV_STATUS_POSTED)
            ->get();

        dd($journals->toArray());

        //todo reporting


        $economic_data = AdminSegment::select('id','name')->where('parent_id','2')->get();
        dd($economic_data->toArray());
       // dd($economic_data->pluck('id','name'));


    }

    public function getJvLedgerReport($params)
    {
        $query = JournalVoucher
            ::join('journal_voucher_details as jd', 'journal_vouchers.id', '=', 'jd.journal_voucher_id')
         //   ->where('journal_vouchers.status', AppConstant::JV_STATUS_POSTED)
        ;

        if(isset($params['inputs']['programme_segment_id']))
        {
            $query = JournalVoucher
                ::join('journal_voucher_details as jd', 'journal_vouchers.id', '=', 'jd.journal_voucher_id')
                   ->where('jd.programme_segment_id', $params['inputs']['programme_segment_id']);
        }

        if(isset($params['inputs']['economic_segment_id']))
        {
            $query = JournalVoucher
                ::join('journal_voucher_details as jd', 'journal_vouchers.id', '=', 'jd.journal_voucher_id')
                ->where('jd.economic_segment_id', $params['inputs']['economic_segment_id']);
        }
        return parent::getAll($params, $query);
    }
}

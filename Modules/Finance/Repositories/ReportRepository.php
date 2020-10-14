<?php


namespace Modules\Finance\Repositories;


use App\Constants\AppConstant;
use Illuminate\Support\Facades\DB;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
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


        //todo reporting

        foreach ($journals as $journal) {

        }

    }
}

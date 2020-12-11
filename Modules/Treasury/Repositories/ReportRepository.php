<?php


namespace Modules\Treasury\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Treasury\Models\PaymentVoucher;

class ReportRepository extends EloquentBaseRepository
{


    public function summaryNonPersonalAdvances($params) {

        $pv =  PaymentVoucher::with([]);
    }

}

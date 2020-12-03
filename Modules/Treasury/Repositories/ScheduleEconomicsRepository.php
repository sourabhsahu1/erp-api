<?php


namespace Modules\Treasury\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Treasury\Models\ScheduleEconomic;

class ScheduleEconomicsRepository extends EloquentBaseRepository
{

    public $model = ScheduleEconomic::class;

    public function create($data)
    {
        $dataToInsert = [];

        foreach ($data['data']['schedule_economics'] as $key => $scheduleEconomic) {
            $dataToInsert[] = [
                'payee_voucher_id' => $data['data']['payee_voucher_id'],
                'economic_segment_id' => $scheduleEconomic['economic_segment_id'],
                'amount' => $scheduleEconomic['amount']
            ];
        }

        ScheduleEconomic::insert($dataToInsert);

        return ["data" => "success"];
    }

    public function getPaymentVoucherScheduleEconomic($params) {

        $query = ScheduleEconomic::with([
            'economic_segment',
            'payee_voucher'
        ])->where('payee_voucher_id', $params['inputs']['payment_voucher_id']);
        return parent::getAll($params, $query);
    }
}

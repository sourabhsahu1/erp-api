<?php


namespace Modules\Treasury\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Treasury\Models\PayeeVoucher;
use Modules\Treasury\Models\ScheduleEconomic;

class ScheduleEconomicsRepository extends EloquentBaseRepository
{

    public $model = ScheduleEconomic::class;

    public function create($data)
    {
        $dataToInsert = [];

        foreach ($data['data']['schedule_economics'] as $key => $scheduleEconomic) {
            /** @var PayeeVoucher $payeeVoucher */
            $payeeVoucher = PayeeVoucher::find($data['data']['payee_voucher_id']);
            $dataToInsert[] = [
                'payment_voucher_id' => $payeeVoucher->payment_voucher_id,
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
            'payee_voucher.employee',
            'payee_voucher.admin_company',
            'payment_voucher'
        ])->where('payment_voucher_id', $params['inputs']['payment_voucher_id']);


        if (isset($params['inputs']['payee_voucher_id'])) {
            $query->where('payee_voucher_id', $params['inputs']['payee_voucher_id']);
        }
        return parent::getAll($params, $query);
    }
}

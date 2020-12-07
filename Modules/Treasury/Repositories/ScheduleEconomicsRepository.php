<?php


namespace Modules\Treasury\Repositories;


use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Treasury\Models\PayeeVoucher;
use Modules\Treasury\Models\PaymentVoucher;
use Modules\Treasury\Models\ScheduleEconomic;

class ScheduleEconomicsRepository extends EloquentBaseRepository
{

    public $model = ScheduleEconomic::class;

    public function create($data)
    {
        $dataToInsert = [];

        $payeeVoucher = PayeeVoucher::find($data['data']['payee_voucher_id']);

        if ($payeeVoucher) {
            /** @var PaymentVoucher $paymentVoucher */
            $paymentVoucher = PaymentVoucher::find($payeeVoucher->payment_voucher_id);
            if ($paymentVoucher->status != 'NEW') {
                throw new AppException('Cannot Add status is not NEW');
            }

        } else {
            throw new AppException('Payee not Exist');
        }

        if (!isset($data['data']['schedule_economics'])) {
            ScheduleEconomic::where('payee_voucher_id', $data['data']['payee_voucher_id'])->delete();
            return ["data" => "success"];
        } else {
            ScheduleEconomic::where('payee_voucher_id', $data['data']['payee_voucher_id'])->delete();
        }

        $totalAmount = 0;
        foreach ($data['data']['schedule_economics'] as $key => $scheduleEconomic) {
            /** @var PayeeVoucher $payeeVoucher */

            $dataToInsert[] = [
                'payment_voucher_id' => $payeeVoucher->payment_voucher_id,
                'payee_voucher_id' => $data['data']['payee_voucher_id'],
                'economic_segment_id' => $scheduleEconomic['economic_segment_id'],
                'amount' => $scheduleEconomic['amount']
            ];

            $totalAmount = $totalAmount + $scheduleEconomic['amount'];
        }


        if ($payeeVoucher->net_amount < $totalAmount) {
            throw new AppException('Given Amount is not equal to gross amount of Schedule Payee');
        }
        ScheduleEconomic::insert($dataToInsert);

        return ["data" => "success"];
    }

    public function getPaymentVoucherScheduleEconomic($params)
    {

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

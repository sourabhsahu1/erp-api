<?php


namespace Modules\Treasury\Repositories;


use App\Constants\AppConstant;
use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Treasury\Models\ReceiptPayee;
use Modules\Treasury\Models\ReceiptScheduleEconomic;
use Modules\Treasury\Models\ReceiptVoucher;

class ReceiptScheduleEconomicRepository extends EloquentBaseRepository
{
    public $model = ReceiptScheduleEconomic::class;


    public function create($data)
    {
        $dataToInsert = [];

        /** @var ReceiptPayee $receiptPayee */
        $receiptPayee = ReceiptPayee::find($data['data']['receipt_payee_id']);

        if ($receiptPayee) {
            /** @var ReceiptVoucher $receiptVoucher */
            $receiptVoucher = ReceiptVoucher::find($receiptPayee->receipt_voucher_id);
            if ($receiptVoucher->status != 'NEW') {
                throw new AppException('Cannot Add status is not NEW');
            }

        } else {
            throw new AppException('Payee not Exist');
        }

        if (!isset($data['data']['schedule_economics'])) {
//            ScheduleEconomic::where('payee_voucher_id', $data['data']['payee_voucher_id'])->delete();
            return ["data" => "Empty schedule economics"];
        } else {
            ReceiptScheduleEconomic::where('receipt_payee_id', $data['data']['receipt_payee_id'])->delete();
        }

        $totalAmount = 0;
        foreach ($data['data']['schedule_economics'] as $key => $scheduleEconomic) {
            /** @var ReceiptPayee $receiptPayee */

            $dataToInsert[] = [
                'receipt_voucher_id' => $receiptPayee->receipt_voucher_id,
                'receipt_payee_id' => $data['data']['receipt_payee_id'],
                'economic_segment_id' => $scheduleEconomic['economic_segment_id'],
                'amount' => $scheduleEconomic['amount']
            ];

            $totalAmount = $totalAmount + $scheduleEconomic['amount'];
        }


        if (($receiptPayee->total_amount) < $totalAmount) {
            throw new AppException('Given Amount is not equal to gross amount of Receipt Schedule Payee');
        }
        ReceiptScheduleEconomic::insert($dataToInsert);

        return ["data" => "success"];
    }


    public function getReceiptVoucherScheduleEconomic($params)
    {

        $query = ReceiptScheduleEconomic::with([
            'economic_segment',
            'receipt_payee.employee',
            'receipt_payee.admin_company',
            'receipt_voucher'
        ])->where('receipt_voucher_id', $params['inputs']['receipt_voucher_id']);


        if (isset($params['inputs']['receipt_payee_id'])) {
            $query->where('receipt_payee_id', $params['inputs']['receipt_payee_id']);
        }
        return parent::getAll($params, $query);
    }


    public function update($data)
    {

        /** @var ReceiptPayee $receiptPayee */
        $receiptPayee = ReceiptPayee::find($data['data']['receipt_payee_id']);

        if ($receiptPayee) {
            /** @var ReceiptVoucher $receiptVoucher */
            $receiptVoucher = ReceiptVoucher::find($receiptPayee->receipt_voucher_id);

            if ($receiptVoucher->status != 'NEW') {
                throw new AppException('Cannot Update status is not NEW');
            }
        }else {
            throw new AppException('Payer not exist');
        }

        return parent::update($data);
    }


    public function delete($data)
    {

        /** @var ReceiptPayee $receiptPayee */
        $receiptPayee = ReceiptPayee::find($data['data']['receipt_payee_id']);

        if ($receiptPayee) {
            /** @var ReceiptVoucher $receiptVoucher */
            $receiptVoucher = ReceiptVoucher::find($receiptPayee->receipt_voucher_id);
            if ($receiptVoucher->status != 'NEW') {
                throw new AppException('Cannot delete status is not NEW');
            }
        }else {
            throw new AppException('Payer not exist');
        }

        $data['id'] = $data['data']['schedule_economic'];
        return parent::delete($data);
    }
}

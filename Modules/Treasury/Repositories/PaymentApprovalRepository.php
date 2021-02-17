<?php


namespace Modules\Treasury\Repositories;


use App\Constants\AppConstant;
use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Treasury\Models\PaymentApproval;
use Modules\Treasury\Models\PaymentApprovalPayee;

class PaymentApprovalRepository extends EloquentBaseRepository
{

    public $model = PaymentApproval::class;


    public function getAll($params = [], $query = null)
    {
        if (isset($params['inputs']['in_use'])) {
            $query = PaymentApproval::with([
                'admin_segment',
                'fund_segment',
                'economic_segment',
                'currency',
                'authorised_by',
                'prepared_by',
                'payment_approval_payees.company.company_bank.bank',
                'payment_approval_payees.company.company_bank.bank_branch',
                'payment_approval_payees.employee.employee_bank.bank',
                'payment_approval_payees.employee.employee_bank.branches',
                'payment_vouchers'
            ])->whereIn('status', [
                AppConstant::PAYMENT_APPROVAL_READY_FOR_PV,
                AppConstant::PAYMENT_APPROVAL_APPROVED_AND_READY
            ]);
        }
        return parent::getAll($params, $query); // TODO: Change the autogenerated stub
    }

    public function create($data)
    {
        $data['data']['prepared_by_id'] = $data['data']['user_id'];
        $data['data']['status'] = 'NEW';



        return parent::create($data);
    }

    public function updateStatus($data)
    {

        foreach (json_decode($data['data']['payment_approval_ids'], true) as $payment_approval_id) {

            $payeeVoucher = PaymentApprovalPayee::where('payment_approval_id', $payment_approval_id)->get();

            if ($payeeVoucher->isEmpty()) {
                throw new AppException('Payee not added for Payment Approval Id ' . $payment_approval_id);
            }
        }

        $pa = PaymentApproval::whereIn('id', json_decode($data['data']['payment_approval_ids'], true));
        $pa->update([
            'status' => $data['data']['status']
        ]);
        return [
            'data' => 'Status Updated Successfully'
        ];
    }


    public function update($data)
    {

        $paymentApproval = PaymentApproval::find($data['id']);
        if ($paymentApproval->status != AppConstant::PAYMENT_APPROVAL_NEW) {
            throw new AppException('Only New Status can be edited');
        }
        $data['data']['status'] = $paymentApproval->status;
        return parent::update($data);
    }

    public function delete($data)
    {
        $paymentApproval = PaymentApproval::find($data['id']);
        if ($paymentApproval->status != AppConstant::PAYMENT_APPROVAL_NEW) {
            throw new AppException('Only New Status can be Delete');
        }
        $data['data']['status'] = $paymentApproval->status;
        return parent::delete($data);
    }

}

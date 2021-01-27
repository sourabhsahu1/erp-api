<?php


namespace Modules\Treasury\Repositories;

use Illuminate\Support\Facades\DB;
use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Admin\Models\CompanyBank;
use Modules\Hr\Models\EmployeeBankDetail;
use Modules\Treasury\Models\PayeeVoucher;
use Modules\Treasury\Models\PaymentApprovalPayee;
use Modules\Treasury\Models\PaymentVoucher;

class PayeeVoucherRepository extends EloquentBaseRepository
{

    public $model = PayeeVoucher::class;

    public function create($data)
    {

        DB::beginTransaction();
        try {

            /** @var PaymentVoucher $pv */
            $pv = PaymentVoucher::find($data['data']['payment_voucher_id']);

            if ($pv->is_previous_year_advance == false) {
                if (isset($data['data']['employee_id'])) {

                    $payeeV = PayeeVoucher::where('employee_id', $data['data']['employee_id'])->where('payment_voucher_id', $data['data']['payment_voucher_id'])->first();

                    if ($payeeV) {
                        throw new AppException('Cannot add Duplicate Payee');
                    }
                    $empBank = EmployeeBankDetail::where('employee_id', $data['data']['employee_id'])->first();
                    if (is_null($empBank)) {
                        throw new AppException('Bank Required to Add Payee Employee');
                    }

                    EmployeeBankDetail::where('id', $data['data']['payee_bank_id'])->update([
                        'is_active' => true
                    ]);
                } elseif (isset($data['data']['company_id'])) {
                    $payeeV = PayeeVoucher::where('company_id', $data['data']['company_id'])->where('payment_voucher_id', $data['data']['payment_voucher_id'])->first();
                    if ($payeeV) {
                        throw new AppException('Cannot add Duplicate Payee');
                    }
                    $compBank = CompanyBank::where('company_id', $data['data']['company_id'])->first();
                    if (is_null($compBank)) {
                        throw new AppException('Bank Required to Add Payee Company');
                    }
                    CompanyBank::where('id', $data['data']['payee_bank_id'])->update([
                        'is_active' => true
                    ]);
                }
            }


            //todo logic to write approval deduction

            /** @var PayeeVoucher $payee */


            if ($pv->is_payment_approval == true) {
                $approvalPayees = PaymentApprovalPayee::whereHas('payment_approval', function ($q) use ($data) {
                    $q->whereHas('payment_vouchers', function ($q) use ($data) {
                        $q->where('id', $data['data']['payment_voucher_id']);
                    });
                })->get();

                if ($approvalPayees->isEmpty()) {
                    throw new AppException('no approval payee added');
                }

                $sum = 0;
                foreach ($approvalPayees as $approvalPayee) {
                    $sum = $approvalPayee->remaining_amount + $sum;
                }

                if ($data['data']['net_amount'] > $sum) {
                    throw new AppException('Insufficient Amount in Payee Approval');
                }

                $payee = parent::create($data);
                foreach ($approvalPayees as $approvalPayee) {
                    $remainingAmount = $approvalPayee->remaining_amount - $data['data']['net_amount'];
                    if ($remainingAmount < 0) {
                        $paymentApprovalPayee = PaymentApprovalPayee::where('id', $approvalPayee->id)->update([
                            'remaining_amount' => 0
                        ]);
                        $data['data']['net_amount'] = $data['data']['net_amount'] - $approvalPayee->remaining_amount;
                    } elseif ($remainingAmount >= 0) {

                        $paymentApprovalPayee = PaymentApprovalPayee::where('id', $approvalPayee->id)->update([
                            'remaining_amount' => $remainingAmount
                        ]);
                    }
                }
            } else {
                $payee = parent::create($data);
            }


            DB::commit();
            return $payee;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }


    public function update($data)
    {

        //todo payemnt approval deduction

        return parent::update($data);
    }

    public function getAll($params = [], $query = null)
    {
        $query = PayeeVoucher::with([
            'admin_company.company_bank.bank',
            'admin_company.company_bank.bank_branch',
            'employee.employee_bank.bank',
            'employee.employee_bank.branches'
        ]);
        return parent::getAll($params, $query);
    }

}

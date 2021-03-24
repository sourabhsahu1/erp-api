<?php


namespace Modules\Treasury\Repositories;

use App\Constants\AppConstant;
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
            $payee = PayeeVoucher::where('payment_voucher_id', $data['data']['payment_voucher_id']);
            $pId = isset($data['data']['employee_id']) ? $data['data']['employee_id'] : $data['data']['company_id'];

            $payeeArray = isset($data['data']['employee_id']) ? $payee->pluck('employee_id')->all() : $payee->pluck('company_id')->all();

            //check for already existed payee
            if (isset($payeeArray) && in_array($pId, $payeeArray)) {
                throw new AppException('Employee Already Exist');
            }

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
                /** @var PayeeVoucher $payee */
                $payee = parent::create($data);

                $payeeApproval = PaymentApprovalPayee::create([
                    'payment_approval_id' => $pv->payment_approve_id,
                    'year' => $payee->year,
                    'details' => $payee->details,
                    'employee_id' => $payee->employee_id,
                    'company_id' => $payee->company_id,
                    'net_amount' => $payee->net_amount,
                    'remaining_amount' => $payee->net_amount,
                    'total_tax' => $payee->total_tax,
                    'tax_ids' => $payee->tax_ids
                ]);
            } elseif ($pv->is_payment_approval == true) {
                //todo logic to write approval deduction
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
            } elseif ($pv->is_previous_year_advance == true) {
                if (isset($data['data']['employee_id'])) {

                    $payeeV = PayeeVoucher::where('employee_id', $data['data']['employee_id'])->where('payment_voucher_id', $data['data']['payment_voucher_id'])->first();

                    if ($payeeV) {
                        throw new AppException('Cannot add Duplicate Payee');
                    }
                    $empBank = EmployeeBankDetail::where('employee_id', $data['data']['employee_id'])->first();
                    if (is_null($empBank)) {
                        throw new AppException('Bank Required to Add Payee Employee');
                    }

//                    EmployeeBankDetail::where('id', $data['data']['payee_bank_id'])->update([
//                        'is_active' => true
//                    ]);
                } elseif (isset($data['data']['company_id'])) {
                    $payeeV = PayeeVoucher::where('company_id', $data['data']['company_id'])->where('payment_voucher_id', $data['data']['payment_voucher_id'])->first();
                    if ($payeeV) {
                        throw new AppException('Cannot add Duplicate Payee');
                    }
                    $compBank = CompanyBank::where('company_id', $data['data']['company_id'])->first();
                    if (is_null($compBank)) {
                        throw new AppException('Bank Required to Add Payee Company');
                    }
//                    CompanyBank::where('id', $data['data']['payee_bank_id'])->update([
//                        'is_active' => true
//                    ]);
                }
                /** @var PayeeVoucher $payee */
                $payee = parent::create($data);

                $payeeApproval = PaymentApprovalPayee::create([
                    'payment_approval_id' => $pv->payment_approve_id,
                    'year' => $payee->year,
                    'details' => $payee->details,
                    'employee_id' => $payee->employee_id,
                    'company_id' => $payee->company_id,
                    'net_amount' => $payee->net_amount,
                    'remaining_amount' => $payee->net_amount,
                    'total_tax' => $payee->total_tax,
                    'tax_ids' => $payee->tax_ids
                ]);
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

        $payeeVCheck = PayeeVoucher::where('id', $data['id'])
            ->first();

        if (isset($data['data']['employee_id'])) {
            $payeeV = PayeeVoucher::where('employee_id', $data['data']['employee_id'])
                ->where('payment_voucher_id', $data['data']['payment_voucher_id'])
                ->first();

            if (!is_null($payeeV) && ($payeeV->employee_id !== $payeeVCheck->employee_id)) {
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
            $payeeV = PayeeVoucher::where('company_id', $data['data']['company_id'])
                ->where('payment_voucher_id', $data['data']['payment_voucher_id'])
                ->first();
            if (!is_null($payeeV) && ($payeeV->company_id !== $payeeVCheck->company_id)) {
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
        /** @var PaymentVoucher $pv */
        $pv = PaymentVoucher::find($data['data']['payment_voucher_id']);

        if (is_null($pv)) {
            throw new AppException('Payment voucher not exist for payee ');
        } else {
            if ($pv->status != AppConstant::VOUCHER_STATUS_NEW) {
                throw new AppException('Cannot Update Status of Payment Voucher is Not NEW');
            }
        }


        return parent::update($data);
    }


    public function delete($data)
    {

        /** @var PaymentVoucher $pv */
        $pv = PaymentVoucher::find($data['data']['payment_voucher_id']);

        if (is_null($pv)) {
            throw new AppException('Payment voucher not exist for payee ');
        } else {
            if ($pv->status != AppConstant::VOUCHER_STATUS_NEW) {
                throw new AppException('Cannot Delete Status of Payment Voucher is Not NEW');
            }
        }
        $data['id'] = $data['data']['schedule_payee'];
        return parent::delete($data); // TODO: Change the autogenerated stub
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

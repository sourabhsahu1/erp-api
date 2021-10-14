<?php


namespace Modules\Treasury\Repositories;


use App\Constants\AppConstant;
use Illuminate\Support\Facades\DB;
use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Admin\Models\CompanyBank;
use Modules\Hr\Models\EmployeeBankDetail;
use Modules\Treasury\Models\PayeeApprovalCustomTax;
use Modules\Treasury\Models\PaymentApproval;
use Modules\Treasury\Models\PaymentApprovalPayee;

class PaymentApprovalPayeesRepository extends EloquentBaseRepository
{
    public $model = PaymentApprovalPayee::class;

    public function create($data)
    {

        $data['data']['remaining_amount'] = $data['data']['net_amount'];
        if (isset($data['data']['employee_id'])) {

            $empBank = EmployeeBankDetail::where('employee_id', $data['data']['employee_id'])->first();

            if (is_null($empBank)) {
                throw new AppException('Bank Required to Add Payee Employee');
            }
            EmployeeBankDetail::where('id', $data['data']['payee_bank_id'])->update([
                'is_active' => true
            ]);


        }

        if (isset($data['data']['company_id'])) {

            $compBank = CompanyBank::where('company_id', $data['data']['company_id'])->first();

            if (is_null($compBank)) {
                throw new AppException('Bank Required to Add Payee Company');
            }

            CompanyBank::where('id', $data['data']['payee_bank_id'])->update([
                'is_active' => true
            ]);
        }
        $payee = parent::create($data);

        $payeeApprovalTax = [];
        //if tax enabled
        if (isset($data['data']['tax_ids'])) {
            $data['data']['tax_ids'] = json_decode($data['data']['tax_ids'], true);
            foreach ($data['data']['tax_ids'] as $tax) {
                $temp['payment_approval_payee_id'] = $payee->id;
                $temp['tax_id'] = $tax['id'];
                $temp['tax_percentage'] = $tax['tax'];
                $payeeApprovalTax[] = $temp;
            }
            PayeeApprovalCustomTax::insert($payeeApprovalTax);
        }
        return $payee;
    }


    public function getAll($params = [], $query = null)
    {
        $query = PaymentApprovalPayee::with([
            'company.company_bank.bank',
            'company.company_bank.bank_branch',
            'employee.employee_bank.bank',
            'employee.employee_bank.branches',
            'payee_taxes'
        ]);
        return parent::getAll($params, $query);
    }


    public function update($data)
    {
        $paymentApproval = PaymentApproval::find($data['data']['payment_approval_id']);

        if ($paymentApproval->status != AppConstant::PAYMENT_APPROVAL_NEW) {
            throw new AppException('Can Update only when Payment Approval Status is New');
        }
        $data['data']['remaining_amount'] = $data['data']['net_amount'];
        $ids = [];
      $paUpdate =  parent::update($data);
        if (isset($data['data']['tax_ids'])) {
            $data['data']['tax_ids'] = json_decode($data['data']['tax_ids'], true);
            foreach ($data['data']['tax_ids'] as $tax) {
                $ids[] = $tax['id'];
                $payeeApprovalTax = PayeeApprovalCustomTax::where('payment_approval_payee_id', $data['id'])
                    ->where('tax_id', $tax['id'])->first();
                if (!$payeeApprovalTax){
                    PayeeApprovalCustomTax::create([
                        'payment_approval_payee_id' => $data['id'],
                        'tax_id' => $tax['id'],
                        'tax_percentage' => $tax['tax']
                    ]);
                }else{
                    $payeeApprovalTax->tax_percentage = $tax['tax'];
                    $payeeApprovalTax->save();
                }
            }

            if (count($ids) > 0) {
                PayeeApprovalCustomTax::where('payment_approval_payee_id', $data['id'])
                    ->whereNotIn('tax_id', $ids)->delete();
            }
        }

        return $paUpdate;
    }


    public function delete($data)
    {

        $paymentApproval = PaymentApproval::find($data['data']['payment_approval_id']);
        if ($paymentApproval->status != AppConstant::PAYMENT_APPROVAL_NEW) {
            throw new AppException('Can Delete only when Payment Approval Status is New');
        }
        $data['id'] = $data['data']['schedule_payee'];
        DB::beginTransaction();

        try {
            $payee = parent::delete($data);
            $payeeTaxes = PayeeApprovalCustomTax::where('payment_approval_payee_id', $data['data']['schedule_payee'])
                ->get();
            if (!$payeeTaxes->isEmpty()) {
                $payeeTaxes->delete();
            }
            DB::commit();
            return $payee;
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }


    }
}

<?php


namespace Modules\Treasury\Repositories;


use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Admin\Models\CompanyBank;
use Modules\Hr\Models\EmployeeBankDetail;
use Modules\Treasury\Models\PaymentApprovalPayee;

class PaymentApprovalPayeesRepository extends EloquentBaseRepository
{
    public $model = PaymentApprovalPayee::class;

    public function create($data)
    {
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
        $payeeBank = parent::create($data);
        return $payeeBank;
    }


    public function getAll($params = [], $query = null)
    {
        $query = PaymentApprovalPayee::with([
            'company.company_bank.bank',
            'company.company_bank.bank_branch',
            'employee.employee_bank.bank',
            'employee.employee_bank.branches'
        ]);
        return parent::getAll($params, $query);
    }
}

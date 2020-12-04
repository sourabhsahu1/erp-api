<?php


namespace Modules\Treasury\Repositories;

use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Admin\Models\CompanyBank;
use Modules\Hr\Models\EmployeeBankDetail;
use Modules\Treasury\Models\PayeeVoucher;

class PayeeVoucherRepository extends EloquentBaseRepository
{

    public $model = PayeeVoucher::class;

    public function create($data)
    {
        $payeeBank = parent::create($data);

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

        return $payeeBank;
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

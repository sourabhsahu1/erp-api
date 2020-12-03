<?php


namespace Modules\Treasury\Repositories;

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
            EmployeeBankDetail::where('id', $data['data']['payee_bank_id'])->update([
                'is_active' => true
            ]);
        }

        if (isset($data['data']['company_id'])) {
            CompanyBank::where('id', $data['data']['payee_bank_id'])->update([
                'is_active' => true
            ]);
        }

        return $payeeBank;
    }


    public function getAll($params = [], $query = null)
    {
        $query = PayeeVoucher::with([
            'admin_company.company_banks.bank',
            'admin_company.company_banks.bank_branch',
            'employee.employee_banks.bank',
            'employee.employee_banks.branches'
        ]);
        return parent::getAll($params, $query);
    }
}

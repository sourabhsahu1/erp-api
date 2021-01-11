<?php


namespace Modules\Treasury\Repositories;


use App\Constants\AppConstant;
use Carbon\Carbon;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Treasury\Models\PaymentVoucher;
use Modules\Treasury\Models\RetireVoucher;

class RetireVoucherRepository extends EloquentBaseRepository
{
    public $model = RetireVoucher::class;

    public function getAll($params = [], $query = null)
    {
        $this->model = PaymentVoucher::class;
        $query = PaymentVoucher::with([
            'program_segment',
            'economic_segment',
            'functional_segment',
            'geo_code_segment',
            'admin_segment',
            'fund_segment',
            'aie',
            'currency',
            'voucher_source_unit',
            'total_amount',
            'total_tax',
            'payee_vouchers.admin_company.company_bank.bank_branch.hr_bank',
            'payee_vouchers.employee.employee_bank.branches.hr_bank',
            'schedule_economic.economic_segment',
            'paying_officer',
            'checking_officer',
            'financial_controller',
            'retire_vouchers.economic_segment'
        ])->whereIn('type', [
            AppConstant::VOUCHER_TYPE_SPECIAL_VOUCHER,
            AppConstant::VOUCHER_TYPE_STANDING_VOUCHER,
            AppConstant::VOUCHER_TYPE_NON_PERSONAL_VOUCHER
        ]);
        return parent::getAll($params, $query);
    }

    public function create($data)
    {

        foreach ($data['data']['liabilities'] as $key => &$liability) {
            $liability['payment_voucher_id'] = $data['data']['payment_voucher_id'];
            $liability['created_at'] = Carbon::now()->toDateTimeString();
            $liability['updated_at'] = Carbon::now()->toDateTimeString();
        }
        $data['data'] = $data['data']['liabilities'];

        return parent::insert($data);
    }

}

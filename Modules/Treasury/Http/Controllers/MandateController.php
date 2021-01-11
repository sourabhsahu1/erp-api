<?php


namespace Modules\Treasury\Http\Controllers;


use App\Http\Controllers\BaseController;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Treasury\Repositories\MandateRepository;

class MandateController extends BaseController
{

    protected $repository = MandateRepository::class;
    protected $createJob = BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
    protected $indexWith = [
        'cashbook.cashbook_monthly_balances',
        'cashbook.bank_branch',
        'cashbook.bank',
        'cashbook.currency',
        'cashbook.economic_segment',
        'cashbook.fund_owned',
        'first_authorised',
        'second_authorised',
        'prepared',
        'payment_vouchers.program_segment',
        'payment_vouchers.economic_segment',
        'payment_vouchers.functional_segment',
        'payment_vouchers.geo_code_segment',
        'payment_vouchers.admin_segment',
        'payment_vouchers.fund_segment',
        'payment_vouchers.aie',
        'payment_vouchers.currency',
        'payment_vouchers.voucher_source_unit',
        'payment_vouchers.total_amount',
        'payment_vouchers.total_tax',
        'payment_vouchers.payee_vouchers.admin_company.company_bank.bank_branch.hr_bank',
        'payment_vouchers.payee_vouchers.employee.employee_bank.branches.hr_bank',
        'payment_vouchers.schedule_economic.economic_segment',
        'payment_vouchers.paying_officer',
        'payment_vouchers.checking_officer',
        'payment_vouchers.financial_controller'
    ];
}

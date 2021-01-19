<?php


namespace Modules\Treasury\Http\Controllers;


use App\Http\Controllers\BaseController;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Treasury\Repositories\PaymentApprovalRepository;

class PaymentApprovalController extends BaseController
{

    protected $repository = PaymentApprovalRepository::class;
    protected $createJob = BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
    protected $indexWith = [
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
    ];
}

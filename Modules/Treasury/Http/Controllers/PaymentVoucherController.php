<?php


namespace Modules\Treasury\Http\Controllers;


use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Treasury\Repositories\PaymentRepository;

class PaymentVoucherController extends BaseController
{

    protected $repository = PaymentRepository::class;
    protected $createJob = BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $deleteJob = BaseJob::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
    protected $deleteJobMethod = "delete";
    protected $indexWith = [
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
        'payee_vouchers',
        'paying_officer',
        'checking_officer',
        'financial_controller',
        'payment_approval',
        'payment_approval.admin_segment',
        'payment_approval.fund_segment',
        'payment_approval.economic_segment',
        'payment_approval.currency',
        'payment_approval.authorised_by',
        'payment_approval.prepared_by',
        'payment_approval.payment_approval_payees.company.company_bank.bank',
        'payment_approval.payment_approval_payees.company.company_bank.bank_branch',
        'payment_approval.payment_approval_payees.employee.employee_bank.bank',
        'payment_approval.payment_approval_payees.employee.employee_bank.branches'
    ];


    public function updateStatus(Request $request)
    {
        $this->jobMethod = "updateStatus";
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }

    public function typePaymentVoucher(Request $request)
    {
        $this->jobMethod = "typePaymentVoucher";
        return $this->handleCustomEndPointGet(BaseJob::class, $request);
    }


    public function statusPaymentVoucher(Request $request)
    {
        $this->jobMethod = "statusPaymentVoucher";
        return $this->handleCustomEndPointGet(BaseJob::class, $request);
    }

    public function storePvAdvances(Request $request)
    {
        $this->jobMethod = "storePvAdvances";
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }

    public function statusUpdatePreviousYearAdvance(Request $request)
    {
        $this->jobMethod = "statusUpdatePreviousYearAdvance";
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }

    public function updatePreviousYearAdvance(Request $request)
    {
        $this->jobMethod = "updatePreviousYearAdvance";
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }

    public function deletePreviousYearAdvance(Request $request)
    {
        $this->customMessage = "Resource deleted successfully";
        $this->jobMethod = "deletePreviousYearAdvance";
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }

    public function getPvAdvances(Request $request)
    {
        $this->jobMethod = "getPvAdvances";
        return $this->handleCustomEndPointGet(BaseJob::class, $request);
    }

    public function downloadPaymentReport(Request $request)
    {
        $this->jobMethod = "downloadPaymentReport";
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }

    public function downloadPaymentTaxReport(Request $request)
    {
        $this->jobMethod = "downloadPaymentTaxReport";
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }


}

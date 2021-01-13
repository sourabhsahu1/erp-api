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
        'company',
        'currency',
        'employee'
    ];
}

<?php


namespace Modules\Treasury\Http\Controllers;


use App\Http\Controllers\BaseController;
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
        'employee',
        'currency',
        'voucher_source_unit',
    ];
}

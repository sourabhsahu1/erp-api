<?php


namespace Modules\Hr\Http\Controllers;


use App\Http\Controllers\BaseController;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Hr\Http\Requests\LeaveGroupMember\Create;
use Modules\Hr\Http\Requests\LeaveGroupMember\Update;
use Modules\Hr\Repositories\LeaveGroupMemberRepository;

class LeaveGroupMemberController extends BaseController
{
    protected $indexWith = [
        'leave_group',
        'employee'
        ];
    protected $repository = LeaveGroupMemberRepository::class;
    protected $createJob =  BaseJob::class;
    protected $updateJob = BaseJob::class;
    protected $deleteJob = BaseJob::class;
    protected $storeJobMethod = "create";
    protected $updateJobMethod = "update";
    protected $deleteJobMethod = "delete";
    protected $storeRequest = Create::class;
    protected $updateRequest = Update::class;
}
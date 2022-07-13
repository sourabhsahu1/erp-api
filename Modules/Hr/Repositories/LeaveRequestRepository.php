<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\LeaveRequest;

class LeaveRequestRepository extends EloquentBaseRepository
{

    public $model = LeaveRequest::class;

    public function getAll($params = [], $query = null)
    {
        if (isset($params["inputs"]["orderby"])) {
            $params["inputs"]["orderby"] = 'name';
            $params['inputs']['order'] = 'asc';
        }

        return parent::getAll($params, $query); // TODO: Change the autogenerated stub
    }
}

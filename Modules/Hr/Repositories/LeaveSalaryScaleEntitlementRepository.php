<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\LeaveSalaryScaleEntitlement;

class LeaveSalaryScaleEntitlementRepository extends EloquentBaseRepository
{

    public $model = LeaveSalaryScaleEntitlement::class;

    public function getAll($params = [], $query = null)
    {

        if (isset($params["inputs"]["orderby"])) {
            $params["inputs"]["orderby"] = 'name';
            $params['inputs']['order'] = 'asc';
        }

        return parent::getAll($params, $query); // TODO: Change the autogenerated stub
    }
}

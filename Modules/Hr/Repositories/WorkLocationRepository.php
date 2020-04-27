<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\WorkLocation;

class WorkLocationRepository extends EloquentBaseRepository
{

    public $model = WorkLocation::class;

    public function getAll($params = [], $query = null)
    {
        $query = WorkLocation::with('sub_categories')->where('parent_id' , null);
        return parent::getAll($params, $query);
    }


}
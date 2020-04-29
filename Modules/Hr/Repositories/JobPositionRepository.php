<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\JobPosition;

class JobPositionRepository extends EloquentBaseRepository
{

    public $model = JobPosition::class;

    public function getAll($params = [], $query = null)
    {
        $query = JobPosition::with('sub_categories')->where('parent_id', null);
        return $query->get();
    }
}
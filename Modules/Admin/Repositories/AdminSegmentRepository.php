<?php


namespace Modules\Admin\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Admin\Models\AdminSegment;

class AdminSegmentRepository extends EloquentBaseRepository
{
    public $model = AdminSegment::class;
}

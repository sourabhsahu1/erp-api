<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\Disengagement;

class DisengagementRepository extends EloquentBaseRepository
{

    public $model = Disengagement::class;
}

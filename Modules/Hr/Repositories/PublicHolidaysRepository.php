<?php


namespace Modules\Hr\Repositories;

use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\PublicHoliday;

class PublicHolidaysRepository extends EloquentBaseRepository
{

    public $model = PublicHoliday::class;
}
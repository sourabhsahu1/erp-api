<?php


namespace Modules\Admin\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Admin\Models\Tax;

class TaxRepository extends EloquentBaseRepository
{

    public $model = Tax::class;
}

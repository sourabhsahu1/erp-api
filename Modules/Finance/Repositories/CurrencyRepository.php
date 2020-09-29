<?php


namespace Modules\Finance\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Finance\Models\Currency;

class CurrencyRepository extends EloquentBaseRepository
{
    public $model = Currency::class;
}

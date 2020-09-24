<?php


namespace Modules\Finance\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\Bank;

class BankRepository extends EloquentBaseRepository
{
    public $model = Bank::class;
}

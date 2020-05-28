<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\AddressType;

class AddressTypeRepository extends EloquentBaseRepository
{
    public $model = AddressType::class;
}

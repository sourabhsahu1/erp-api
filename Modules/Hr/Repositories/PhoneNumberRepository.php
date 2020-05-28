<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\PhoneNumberType;

class PhoneNumberRepository extends EloquentBaseRepository
{
    public $model = PhoneNumberType::class;
}

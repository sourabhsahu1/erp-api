<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\Membership;

class MembershipRepository extends EloquentBaseRepository
{

    public $model = Membership::class;
}
<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\Relationship;

class RelationshipRepository extends EloquentBaseRepository
{

    public $model = Relationship::class;
}
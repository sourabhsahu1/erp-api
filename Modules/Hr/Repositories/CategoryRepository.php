<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\Category;

class CategoryRepository extends EloquentBaseRepository
{

    public $model = Category::class;
}
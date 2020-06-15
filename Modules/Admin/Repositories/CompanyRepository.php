<?php


namespace Modules\Admin\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Admin\Models\Company;


class CompanyRepository extends EloquentBaseRepository
{
    public $model = Company::class;
}

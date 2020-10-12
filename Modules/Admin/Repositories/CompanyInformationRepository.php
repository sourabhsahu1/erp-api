<?php


namespace Modules\Admin\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Admin\Models\CompanyInformation;

class CompanyInformationRepository extends EloquentBaseRepository
{
    public $model = CompanyInformation::class;
}

<?php


namespace Modules\Admin\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Admin\Models\CompanySetting;

class CompanyInformationSettingRepository extends EloquentBaseRepository
{
    public $model = CompanySetting::class;
}

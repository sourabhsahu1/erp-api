<?php


namespace Modules\Treasury\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Treasury\Models\DefaultSetting;

class DefaultSettingRepository extends EloquentBaseRepository
{
    public $model = DefaultSetting::class;
}

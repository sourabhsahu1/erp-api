<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\Language;

class LanguageRepository extends EloquentBaseRepository
{

    public $model = Language::class;
}
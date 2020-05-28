<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\EmployeeLanguage;

class EmployeeLanguageRepository extends EloquentBaseRepository
{

    public $model = EmployeeLanguage::class;

    public function getAll($params = [], $query = null)
    {
        $query = EmployeeLanguage::with([
            'language',
            'employee'
        ])
            ->where('employee_id', $params['inputs']['employee_id']);
        return parent::getAll($params, $query);
    }
}

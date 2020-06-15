<?php


namespace Modules\Admin\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Admin\Models\CompanyBank;

class CompanyBankRepository extends EloquentBaseRepository
{
    public $model = CompanyBank::class;

    public function getAll($params = [], $query = null)
    {
        $query = CompanyBank::with([
            'bank',
            'bank_branch'
        ])
            ->where('company_id', $params['inputs']['company_id']);
        return parent::getAll($params, $query);
    }


}


<?php


namespace Modules\Treasury\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Treasury\Models\VoucherSourceUnit;

class VoucherSourceUnitRepository extends EloquentBaseRepository
{
    public $model = VoucherSourceUnit::class;

    public function getAll($params = [], $query = null)
    {
        $query = VoucherSourceUnit::query();

        if (isset($params['inputs']['search'])) {
            $query->where(function ($d) use ($params) {
                $d->where('long_name', 'like', "%" . $params['inputs']['search'] . "%")
                    ->orWhere('short_name', 'like', "%" . $params['inputs']['search'] . "%");
            });
        }

        return parent::getAll($params, $query);
    }
}

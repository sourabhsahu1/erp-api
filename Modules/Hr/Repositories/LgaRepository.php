<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\Lga;

class LgaRepository extends EloquentBaseRepository
{

    public $model = Lga::class;

    public function getAll($params = [], $query = null)
    {
        $data = parent::getAll($params, $query); // TODO: Change the autogenerated stub
        $items = collect($data['items'])->sortBy('name')->sortBy('state.name')->sortBy('region.country.state.name')->all();
        $data['items'] = array_values($items);
        return $data;
    }
}
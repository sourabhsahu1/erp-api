<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\EmployeeAddress;
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

    public function delete($data)
    {
        $address = EmployeeAddress::where('lga_id', $data['id'])->first();
        if (is_null($address)) {
            return parent::delete($data);
        }else {
            throw new AppException('Already in use');
        }
    }
}

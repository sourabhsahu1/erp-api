<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\Country;
use Modules\Hr\Models\Region;

class CountryRepository extends EloquentBaseRepository
{
    public $model = Country::class;


    public function getAllLocations($params = []) {
        $locations = Country::with('regions.states.lgas');
        return $this->getAll($params, $locations);
    }

    public function delete($data)
    {
        $data = Region::where('country_id', $data['id'])->first();
        if (is_null($data)) {
            return parent::delete($data);
        }else {
            throw new AppException('Already in use');
        }
    }
}

<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\Country;

class CountryRepository extends EloquentBaseRepository
{
    public $model = Country::class;


    public function getAllLocations($params = []) {
        $locations = Country::with('regions.states.lgas');
        return $this->getAll($params, $locations);
    }
}
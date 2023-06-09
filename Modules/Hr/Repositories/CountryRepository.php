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

    public function getAll($params = [], $query = null)
    {
        if (isset($params["inputs"]["orderby"])) {
            $params["inputs"]["orderby"] = 'name';
            $params['inputs']['order'] = 'asc';
        }

        return parent::getAll($params, $query); // TODO: Change the autogenerated stub
    }

    public function delete($data)
    {
        $region = Region::where('country_id', $data['id'])->first();
        if (is_null($region)) {
            return parent::delete($data);
        }else {
            throw new AppException('Already in use');
        }
    }
}

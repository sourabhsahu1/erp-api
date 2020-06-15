<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\Censure;
use Modules\Hr\Models\EmployeeCensure;

class CensureRepository extends EloquentBaseRepository
{

    public $model = Censure::class;

    public function delete($data)
    {
        $data = EmployeeCensure::where('address_type_id', $data['id'])->first();
        if (is_null($data)) {
            return parent::delete($data);
        }else {
            throw new AppException('Already in use');
        }
    }
}

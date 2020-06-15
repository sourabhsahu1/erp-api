<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\AddressType;
use Modules\Hr\Models\EmployeeAddress;

class AddressTypeRepository extends EloquentBaseRepository
{
    public $model = AddressType::class;

    public function delete($data)
    {
        $data = EmployeeAddress::where('address_type_id', $data['id'])->first();
        if (is_null($data)) {
            return parent::delete($data);
        }else {
            throw new AppException('Already in use');
        }
    }
}

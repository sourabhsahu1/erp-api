<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\EmployeePhoneNumber;
use Modules\Hr\Models\PhoneNumberType;

class PhoneNumberRepository extends EloquentBaseRepository
{
    public $model = PhoneNumberType::class;

    public function delete($data)
    {
        $data = EmployeePhoneNumber::where('phone_number_type_id', $data['id'])->first();
        if (is_null($data)) {
            return parent::delete($data);
        }else {
            throw new AppException('Already in use');
        }
    }
}

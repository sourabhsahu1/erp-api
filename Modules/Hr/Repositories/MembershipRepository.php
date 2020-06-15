<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\EmployeeMembership;
use Modules\Hr\Models\Membership;

class MembershipRepository extends EloquentBaseRepository
{

    public $model = Membership::class;

    public function delete($data)
    {
        $data = EmployeeMembership::where('membership_id', $data['id'])->first();
        if (is_null($data)) {
            return parent::delete($data);
        }else {
            throw new AppException('Already in use');
        }
    }
}

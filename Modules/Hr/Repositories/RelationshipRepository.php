<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\EmployeeRelation;
use Modules\Hr\Models\Relationship;

class RelationshipRepository extends EloquentBaseRepository
{

    public $model = Relationship::class;

    public function delete($data)
    {
        $data = EmployeeRelation::where('relationship_id', $data['id'])->first();
        if (is_null($data)) {
            return parent::delete($data);
        }else {
            throw new AppException('Already in use');
        }
    }
}

<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\GradeLevel;

class GradeLevelRepository extends EloquentBaseRepository
{
    public $model = GradeLevel::class;

    public function create($data)
    {
        if (!isset($data['data']['name'])) {
            $currentGradeLevelCount = GradeLevel::where('salary_scale_id', $data['data']['salary_scale_id'])->count() +1;
            $data['data']['name'] = 'Level-'.str_pad($currentGradeLevelCount, 2, '0', STR_PAD_LEFT);
        }
        return parent::create($data);
    }
}
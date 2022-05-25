<?php


namespace Modules\Hr\Repositories;


use Carbon\Carbon;
use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\EmployeeJobProfile;
use Modules\Hr\Models\GradeLevel;
use Modules\Hr\Models\GradeLevelStep;
use Modules\Hr\Models\SalaryScale;

class SalaryScaleRepository extends EloquentBaseRepository
{

    public $model = SalaryScale::class;

    public function getAll($params = [], $query = null)
    {
        $get_by_id = false;
        if (isset($params["inputs"]["get_by_id"])) {
            $get_by_id = true;
        }
        if ($get_by_id) {
            return parent::getAll($params, $query);
        } else {
            return SalaryScale::with('grade_levels.grade_level_steps')->get();
        }
    }

    public function create($data)
    {
        $gradeLevel = null;
        $glSteps = null;
        $salaryScale = parent::create($data);
        if ($data['data']['is_automatic_create'] == true) {
            for ($i = 1; $i <= $data['data']['number_of_levels']; $i++) {
                $levelName = 'Level-';
                $levelName .= str_pad($i, 2, '0', STR_PAD_LEFT);
                $gradeLevel[] = [
                    'salary_scale_id' => $salaryScale->id,
                    'name' => $levelName,
                    'retire_type' => $data['data']['retire_type'],
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon::now()->toDateTimeString()
                ];
            }

            GradeLevel::insert($gradeLevel);
            $gradeLevelIds = GradeLevel::where('salary_scale_id', $salaryScale->id)->pluck('id')->all();

            foreach ($gradeLevelIds as $key => $gradeLevelId) {
                for ($j = 1; $j <= $data['data']['number_of_steps']; $j++) {
                    $glStepName = 'GL-';
                    $glStepName .= str_pad($key + 1, 2, '0', STR_PAD_LEFT) . '-' . str_pad($j, 2, '0', STR_PAD_LEFT);;
                    $glSteps[] = [
                        'name' => $glStepName,
                        'grade_level_id' => $gradeLevelId
                    ];
                }
            }
            GradeLevelStep::insert($glSteps);
        }
        return SalaryScale::with('grade_levels.grade_level_steps')->where('id', $salaryScale->id)->get();
    }

    public function update($data)
    {
        SalaryScale::where('id', $data['id'])->update(['name' => $data['data']['name']]);
        return SalaryScale::with('grade_levels.grade_level_steps')->find($data['id']);
    }

    public function delete($data)
    {
        $grade = GradeLevel::where('salary_scale_id', $data['id'])->first();
        if (is_null($grade)) {
            return parent::delete($data);
        } else {
            throw new AppException('Already in use');
        }
    }
}

<?php


namespace Modules\Hr\Repositories;


use Illuminate\Support\Facades\DB;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\Employee;
use Modules\Hr\Models\JobProfile;
use Modules\Hr\Models\User;


class EmployeeRepository extends EloquentBaseRepository

{

    public $model = Employee::class;

    public function create($data)
    {
        DB::beginTransaction();

        try {

            $employee = Employee::create([
                "first_name" => $data['first_name'],
                "last_name" => $data['last_name'] ?? null,
                "other_names" => $data['other_names'] ?? null,
                "date_of_birth" => $data['date_of_birth'],
                "marital_status" => $data['marital_status'],
                "gender" => $data['gender'],
                "religion" => $data['religion'],
                "phone" => $data['phone'],
                "email" => $data['email'],
                "is_permanent_staff" => $data['is_permanent_staff'],
                "type_of_appointment" => $data['type_of_appointment'],
                "appointed_on" => $data['appointed_on'],
                "assumed_duty" => $data['assumed_duty']
            ]);

            DB::commit();
            return $employee;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateJobProfile($data)
    {
        Employee::where('id', $data['data']['id'])
            ->update([
                'job_position_id' => $data['data']['job_position_id'],
                'department_id' => $data['data']['department_id'],
                'work_location_id' => $data['data']['work_location_id'],
                'designation_id' => $data['data']['designation_id'],
                'salary_scale_id' => $data['data']['salary_scale_id'],
                'grade_level_id' => $data['data']['grade_level_id'],
                'grade_level_step_id' => $data['data']['grade_level_step_id'],
            ]);
        return Employee::find($data['data']['id']);
    }

    public function updateLocation($data)
    {
        Employee::where('id', $data['data']['id'])
            ->update([
                'country_id' => $data['data']['country_id'],
                'region_id' => $data['data']['region_id'],
                'state_id' => $data['data']['state_id'],
                'lga_id' => $data['data']['lga_id'],
                'address' => $data['data']['address'],
                'street' => $data['data']['street'],
                'city' => $data['data']['city'],
                'zip_code' => $data['data']['zip_code']
            ]);
        return Employee::find($data['data']['id']);
    }

}

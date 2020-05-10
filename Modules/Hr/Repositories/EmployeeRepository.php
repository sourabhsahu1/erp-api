<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\Employee;
use Modules\Hr\Models\EmployeeContactDetail;
use Modules\Hr\Models\EmployeeJobProfile;
use Modules\Hr\Models\EmployeePersonalDetail;


class EmployeeRepository extends EloquentBaseRepository

{

    public $model = Employee::class;

    public function create($data)
    {
        $data['data']['created_by_id'] = $data['data']['user_id'];
        return parent::create($data);
    }

    public function update($data)
    {
        return parent::update($data);
    }

    public function employeeDetails($data)
    {
        $employeeDetails = EmployeePersonalDetail::where('employee_id', $data['data']['id'])->get();
        if (is_null($employeeDetails)) {
            $employee = EmployeePersonalDetail::create([
                'employee_id' => $data['data']['id'],
                'date_of_birth' => $data['data']['date_of_birth'],
                'marital_status' => $data['data']['marital_status'],
                'gender' => $data['data']['gender'],
                'religion' => $data['data']['religion'],
                'phone' => $data['data']['phone'],
                'email' => $data['data']['email'],
                'is_permanent_staff' => $data['data']['is_permanent_staff'],
                'type_of_appointment' => $data['data']['type_of_appointment'],
                'appointed_on' => $data['data']['appointed_on'],
                'assumed_duty_on' => $data['data']['assumed_duty_on']
            ]);
        } else {
            $employee = EmployeePersonalDetail::where('employee_id', $data['data']['id'])
                ->update([
                    'date_of_birth' => $data['data']['date_of_birth'],
                    'marital_status' => $data['data']['marital_status'],
                    'gender' => $data['data']['gender'],
                    'religion' => $data['data']['religion'],
                    'phone' => $data['data']['phone'],
                    'email' => $data['data']['email'],
                    'is_permanent_staff' => $data['data']['is_permanent_staff'],
                    'type_of_appointment' => $data['data']['type_of_appointment'],
                    'appointed_on' => $data['data']['appointed_on'],
                    'assumed_duty_on' => $data['data']['assumed_duty_on']
                ]);
        }
        return EmployeePersonalDetail::where('employee_id', $data['data']['id'])->first();
    }


    public function jobProfile($data)
    {
        $employeeJob = EmployeeJobProfile::where('employee_id', $data['data']['id'])->first();
        if (is_null($employeeJob)) {
            $employeeJobProfile = EmployeeJobProfile::create([
                'employee_id' => $data['data']['id'],
                'job_position_id' => $data['data']['job_position_id'],
                'designation_id' => $data['data']['designation_id'],
                'department_id' => $data['data']['department_id'],
                'work_location_id' => $data['data']['work_location_id'],
                'current_appointment' => $data['data']['current_appointment']
            ]);
        }else {
            $employeeJobProfile = EmployeeJobProfile::where('employee_id', $data['data']['id'])
                ->update([
                    'job_position_id' => $data['data']['job_position_id'],
                    'designation_id' => $data['data']['designation_id'],
                    'department_id' => $data['data']['department_id'],
                    'work_location_id' => $data['data']['work_location_id'],
                    'current_appointment' => $data['data']['current_appointment']
                ]);
        }
        return EmployeeJobProfile::where('employee_id', $data['data']['id'])->first();
    }


    public function location($data)
    {
        $employeeLocations  = EmployeeContactDetail::where('employee_id', $data['data']['id'])->first();
        if (is_null($employeeLocations)) {
            $employeeLocations = EmployeeContactDetail::create([
                'employee_id' => $data['data']['id'],
                'country_id' => $data['data']['country_id'],
                'region_id' => $data['data']['region_id'],
                'state_id' => $data['data']['state_id'],
                'lga_id' => $data['data']['lga_id'],
                'address_line_1' => $data['data']['address_line1'],
                'address_line_2' => $data['data']['address_line2'],
                'city' => $data['data']['city'],
                'zip_code' => $data['data']['zip_code'],
                'other_country_id' => $data['data']['other_country_id'],
                'other_region_id' => $data['data']['other_region_id'],
                'other_state_id' => $data['data']['other_state_id'],
                'other_lga_id' => $data['data']['other_lga_id']
            ]);
        }else {
            $employeeLocations = EmployeeContactDetail::where('employee_id', $data['data']['id'])
                ->update([
                    'country_id' => $data['data']['country_id'],
                    'region_id' => $data['data']['region_id'],
                    'state_id' => $data['data']['state_id'],
                    'lga_id' => $data['data']['lga_id'],
                    'address_line_1' => $data['data']['address_line1'],
                    'address_line_2' => $data['data']['address_line2'],
                    'city' => $data['data']['city'],
                    'zip_code' => $data['data']['zip_code'],
                    'other_country_id' => $data['data']['other_country_id'],
                    'other_region_id' => $data['data']['other_region_id'],
                    'other_state_id' => $data['data']['other_state_id'],
                    'other_lga_id' => $data['data']['other_lga_id']
                ]);
        }
        return EmployeeContactDetail::where('employee_id', $data['data']['id'])->first();;
    }


    public function employeeProgression($data) {
        dd($data);
    }
}

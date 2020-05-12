<?php


namespace Modules\Hr\Repositories;


use App\Constants\AppConstant;
use Illuminate\Support\Carbon;
use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\Employee;
use Modules\Hr\Models\EmployeeContactDetail;
use Modules\Hr\Models\EmployeeJobProfile;
use Modules\Hr\Models\EmployeePersonalDetail;
use Modules\Hr\Models\EmployeeProgression;


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
        $employeeDetails = EmployeePersonalDetail::where('employee_id', $data['data']['id'])->first();

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
        } else {
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
        $employeeLocations = EmployeeContactDetail::where('employee_id', $data['data']['id'])->first();
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
        } else {
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


    public function employeeProgression($data)
    {

        $employee = Employee::find($data['data']['id']);
        if (is_null($employee)) {
            throw new  AppException('Employee not Exists');
        }

        /** @var EmployeeJobProfile $employeeJob */
        $employeeJob = EmployeeJobProfile::with('hr_job_position.hr_grade_level')->where('employee_id', $data['data']['id'])->first();

        $gradeLevel = $employeeJob->hr_job_position->hr_grade_level;
        /** @var EmployeePersonalDetail $employeeProfile */
        $employeeProfile = EmployeePersonalDetail::where('employee_id', $data['data']['id'])->first();

        $exitDate = null;
        if ($gradeLevel->retire_type == AppConstant::RETIRE_TYPE_FIRST_APPOINTMENT) {
            $exitDate = Carbon::parse($employeeProfile->appointed_on)->addYears($gradeLevel->retire_after);
        } elseif ($gradeLevel->retire_type == AppConstant::RETIRE_TYPE_DATE_OF_BIRTH) {
            $exitDate = Carbon::parse($employeeProfile->date_of_birth)->addYears($gradeLevel->retire_after);
        } elseif ($gradeLevel->retire_type == AppConstant::RETIRE_TYPE_CURRENT_APPOINTMENT) {
            $exitDate = Carbon::parse($employeeJob->current_appointment)->addYears($gradeLevel->retire_after);
        }


        $progression = EmployeeProgression::where('employee_id', $data['data']['id'])->first();
        if (is_null($progression)) {
            $progression = EmployeeProgression::create([
                'status' => AppConstant::PROGRESSION_STATUS_NEW,
                'employee_id' => $data['data']['id'],
                'confirmation_due_date' => Carbon::parse($data['data']['confirmation_due_date'])->toDateString(),
                'next_increment_due_date' => Carbon::parse($employeeJob->current_appointment)->addMonths($data['data']['next_increment'])->toDateString(),
                'expected_exit_date' => $exitDate->toDateString(),
                'next_promotion_due_date' => Carbon::parse($employeeJob->current_appointment)->addMonths($data['data']['next_promotion'])->toDateString()
            ]);
        }

        return $progression;
    }



    public function setStatusForEmployee($data) {

        if ($data['data']['status'] == 'ACTIVE'){
            foreach ($data['data']['employee_ids'] as $employee_id) {
                $employee = EmployeeProgression::where('employee_id', $employee_id)
                    ->update(['status' => AppConstant::PROGRESSION_STATUS_ACTIVE]);
            }
        }elseif ($data['data']['status'] == 'CONFIRMED') {
            foreach ($data['data']['employee_ids'] as $employee_id) {
                $employee = EmployeeProgression::where('employee_id', $employee_id)
                    ->update([
                        'status' => AppConstant::PROGRESSION_STATUS_ACTIVE,
                        'confirmed_date' => Carbon::now()->toDateString()
                    ]);
            }
        }elseif ($data['data']['status'] == 'INCREMENT') {
            foreach ($data['data']['employee_ids'] as $employee_id) {
                $employee = EmployeeProgression::where('employee_id', $employee_id)
                    ->update([
                        'last_increment' => Carbon::now()->toDateString()
                    ]);
            }
        }elseif ($data['data']['status'] == 'PROMOTION') {
            foreach ($data['data']['employee_ids'] as $employee_id) {
                $employee = EmployeeProgression::where('employee_id', $employee_id)
                    ->update([
                        'last_promoted' => Carbon::now()->toDateString()
                    ]);
            }
        }elseif ($data['data']['status'] == 'RETIRE') {
            foreach ($data['data']['employee_ids'] as $employee_id) {
                $employee = EmployeeProgression::where('employee_id', $employee_id)
                    ->update([
                        'actual_exit_date' => Carbon::now()->toDateString()
                    ]);
            }
        }
    }



    public function getStatusEmployee($params) {

        $employees = Employee::whereHas('employee_progressions', function ($query){
            $query->whereDate('confirmation_due_date', '>', Carbon::now()->toDateTimeString());
        })->get();

        dd($employees);
    }

}

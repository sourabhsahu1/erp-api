<?php


namespace Modules\Hr\Repositories;


use App\Constants\AppConstant;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\Employee;
use Modules\Hr\Models\EmployeeContactDetail;
use Modules\Hr\Models\EmployeeIdNo;
use Modules\Hr\Models\EmployeeInternationalPassport;
use Modules\Hr\Models\EmployeeJobProfile;
use Modules\Hr\Models\EmployeePension;
use Modules\Hr\Models\EmployeePersonalDetail;
use Modules\Hr\Models\EmployeeProgression;


class EmployeeRepository extends EloquentBaseRepository

{

    public $model = Employee::class;

    public function create($data)
    {
        if (isset($data['data']['file_id'])) {
            $data['data']['profile_image_id'] = $data['data']['file_id'];
        }
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
        $employeeJob = EmployeeJobProfile::with('hr_job_position.grade_level')->where('employee_id', $data['data']['id'])->first();
        $data['data']['status'] = AppConstant::PROGRESSION_STATUS_NEW;
        $gradeLevel = $employeeJob->hr_job_position->grade_level;
        /** @var EmployeePersonalDetail $employeeProfile */
        $employeeProfile = EmployeePersonalDetail::where('employee_id', $data['data']['id'])->first();

        if (!isset($data['data']['expected_exit_date'])) {
            $data['data']['expected_exit_date'] = null;
            if ($gradeLevel->retire_type == AppConstant::RETIRE_TYPE_FIRST_APPOINTMENT) {
                $data['data']['expected_exit_date'] = Carbon::parse($employeeProfile->appointed_on)->addYears($gradeLevel->retire_after)->toDateString();
            } elseif ($gradeLevel->retire_type == AppConstant::RETIRE_TYPE_DATE_OF_BIRTH) {
                $data['data']['expected_exit_date'] = Carbon::parse($employeeProfile->date_of_birth)->addYears($gradeLevel->retire_after)->toDateString();
            } elseif ($gradeLevel->retire_type == AppConstant::RETIRE_TYPE_CURRENT_APPOINTMENT) {
                $data['data']['expected_exit_date'] = Carbon::parse($employeeJob->current_appointment)->addYears($gradeLevel->retire_after)->toDateString();
            }
        }

        if ($data['data']['is_confirmed'] == true) {
            $data['data']['confirmed_date'] = Carbon::now()->toDateString();
        }
        if ($data['data']['is_exited'] == true) {
            $data['data']['actual_exit_date'] = Carbon::now()->toDateString();
            $data['data']['status'] = AppConstant::PROGRESSION_STATUS_RETIRE;
        }

        $data['data']['confirmation_due_date'] = isset($data['data']['confirmation_due_date']) ? $data['data']['confirmation_due_date'] : null;
        $data['data']['last_increment'] = isset($data['data']['last_increment']) ? $data['data']['last_increment'] : null;
        $data['data']['last_promoted'] = isset($data['data']['last_promoted']) ? $data['data']['last_promoted'] : null;
        $data['data']['next_increment_due_date'] = Carbon::parse($employeeJob->current_appointment)->addMonths($data['data']['next_increment'])->toDateString();
        $data['data']['next_promotion_due_date'] = Carbon::parse($employeeJob->current_appointment)->addMonths($data['data']['next_promotion'])->toDateString();
        $progression = EmployeeProgression::where('employee_id', $data['data']['id'])->first();
        DB::beginTransaction();
        try {
            if (is_null($progression)) {
                $progression = EmployeeProgression::create([
                    'status' => $data['data']['status'],
                    'employee_id' => $data['data']['id'],
                    'confirmation_due_date' => $data['data']['confirmation_due_date'],
                    'confirmed_date' => $data['data']['confirmed_date'] ?? null,
                    'next_increment_due_date' => $data['data']['next_increment_due_date'],
                    'last_increment' => $data['data']['last_increment'],
                    'expected_exit_date' => $data['data']['expected_exit_date'],
                    'actual_exit_date' => $data['data']['actual_exit_date'] ?? null,
                    'next_promotion_due_date' => $data['data']['next_promotion_due_date'],
                    'last_promoted' => $data['data']['last_promoted'],
                ]);
            }

            $employeeJob = EmployeePension::create([
                'is_pension_started' => $data['data']['is_pension_started'],
                'employee_id' => $data['data']['id'],
                'date_started' => $data['data']['date_started'] ?? null,
                'gratuity' => $data['data']['gratuity'] ?? null,
                'monthly_pension' => $data['data']['monthly_pension'] ?? null,
                'other_pension' => $data['data']['other_pension'] ?? null,
            ]);
            DB::commit();
        }catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return $progression;
    }


    public function setStatusForEmployee($data)
    {
        if ($data['data']['status'] == 'ACTIVE') {
            foreach ($data['data']['employee_ids'] as $employee_id) {
                $employee = EmployeeProgression::where('employee_id', $employee_id)
                    ->update(['status' => AppConstant::PROGRESSION_STATUS_ACTIVE]);
            }
        } elseif ($data['data']['status'] == 'CONFIRMED') {
            foreach ($data['data']['employee_ids'] as $employee_id) {
                $employee = EmployeeProgression::where('employee_id', $employee_id)
                    ->update([
                        'confirmed_date' => Carbon::now()->toDateString()
                    ]);
            }
        } elseif ($data['data']['status'] == 'INCREMENT') {
            foreach ($data['data']['employee_ids'] as $employee_id) {
                $employee = EmployeeProgression::where('employee_id', $employee_id)
                    ->update([
                        'last_increment' => Carbon::now()->toDateString()
                    ]);
            }
        } elseif ($data['data']['status'] == 'PROMOTION') {
            foreach ($data['data']['employee_ids'] as $employee_id) {
                $employee = EmployeeProgression::where('employee_id', $employee_id)
                    ->update([
                        'last_promoted' => Carbon::now()->toDateString()
                    ]);
            }
        } elseif ($data['data']['status'] == 'RETIRE') {
            foreach ($data['data']['employee_ids'] as $employee_id) {
                $employee = EmployeeProgression::where('employee_id', $employee_id)
                    ->update([
                        'actual_exit_date' => Carbon::now()->toDateString()
                    ]);
            }
        }
    }

    public function getAll($params = [], $query = null)
    {
        $query = Employee::query();
        if (isset($params['inputs']['status'])) {
            if ($params['inputs']['status'] = AppConstant::PROGRESSION_STATUS_NEW) {
                $query->whereHas('employee_progressions', function ($query) {
                    $query->where('status', AppConstant::PROGRESSION_STATUS_NEW);
                });
            } elseif ($params['inputs']['status'] = AppConstant::PROGRESSION_STATUS_ACTIVE) {
                $query->whereHas('employee_progressions', function ($query) {
                    $query->where('status', AppConstant::PROGRESSION_STATUS_ACTIVE);
                });
            } elseif ($params['inputs']['status'] = AppConstant::PROGRESSION_STATUS_CONFIRMED) {
                $query->whereHas('employee_progressions', function ($query) {
                    $query->whereNotNull('confirmed_date');
                });
            } elseif ($params['inputs']['status'] = AppConstant::PROGRESSION_STATUS_CONFIRMATION_DUE) {
                $query->whereHas('employee_progressions', function ($query) {
                    $query->whereDate('confirmation_due_date', '>', Carbon::now()->toDateTimeString());
                });
            } elseif ($params['inputs']['status'] = AppConstant::PROGRESSION_STATUS_RETIREMENT_DUE) {
                $query->whereHas('employee_progressions', function ($query) {
                    $query->whereDate('expected_exit_date', '>', Carbon::now()->toDateTimeString());
                });
            } elseif ($params['inputs']['status'] = AppConstant::PROGRESSION_STATUS_INCREMENT_DUE) {
                $query->whereHas('employee_progressions', function ($query) {
                    $query->whereDate('next_increment_due_date', '>', Carbon::now()->toDateTimeString());
                });
            } elseif ($params['inputs']['status'] = AppConstant::PROGRESSION_STATUS_PROMOTION_DUE) {
                $query->whereHas('employee_progressions', function ($query) {
                    $query->whereDate('next_promotion_due_date', '>', Carbon::now()->toDateTimeString());
                });
            }
        }
        return parent::getAll($params, $query); // TODO: Change the autogenerated stub
    }


    public function show($id, $params = null)
    {
        $params['with'] = [
            'employee_contact_details.country',
            'employee_contact_details.region',
            'employee_contact_details.state',
            'employee_contact_details.lga',
            'employee_contact_details.other_country',
            'employee_contact_details.other_region',
            'employee_contact_details.other_state',
            'employee_contact_details.other_lga',
            'employee_job_profiles.department',
            'employee_job_profiles.designation',
            'employee_job_profiles.hr_job_position',
            'employee_job_profiles.work_location',
            'employee_personal_details',
            'employee_progressions',
            'employee_id_nos',
            'employee_international_passports',
            'employee_pensions',
            'file'
        ];
        return parent::show($id, $params); // TODO: Change the autogenerated stub
    }


    public function employeeIdNos($data)
    {
        $this->model = EmployeeIdNo::class;
        $data['data']['employee_id'] = $data['data']['id'];
        $employeeIdno = EmployeeIdNo::where('employee_id', $data['data']['id'])->first();
        if (is_null($employeeIdno)) {
           $employeeIdno =  parent::create($data);
        }else {
            $data['id'] = $data['data']['id'];
            parent::update($data);
        }

        $this->model = EmployeeInternationalPassport::class;
        $employeePassport = EmployeeInternationalPassport::where('employee_id', $data['data']['id'])->first();
        if (is_null($employeePassport)) {
            $employeePassport =  parent::create($data);
        }else {
            $data['id'] = $data['data']['id'];
            parent::update($data);
        }


        return array_merge($employeeIdno->toArray(),$employeePassport->toArray());
    }
}

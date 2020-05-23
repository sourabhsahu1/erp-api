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
                'date_of_birth' => Carbon::parse($data['data']['date_of_birth'])->toDateString(),
                'marital_status' => $data['data']['marital_status'],
                'gender' => $data['data']['gender'],
                'religion' => $data['data']['religion'],
                'phone' => $data['data']['phone'],
                'email' => $data['data']['email'],
                'is_permanent_staff' => $data['data']['is_permanent_staff'] ?? false,
                'type_of_appointment' => $data['data']['type_of_appointment'],
                'appointed_on' => Carbon::parse($data['data']['appointed_on'])->toDateString(),
                'assumed_duty_on' => Carbon::parse($data['data']['assumed_duty_on'])->toDateString()
            ]);
        } else {
            $employee = EmployeePersonalDetail::where('employee_id', $data['data']['id'])
                ->update([
                    'date_of_birth' => Carbon::parse($data['data']['date_of_birth'])->toDateString(),
                    'marital_status' => $data['data']['marital_status'],
                    'gender' => $data['data']['gender'],
                    'religion' => $data['data']['religion'],
                    'phone' => $data['data']['phone'],
                    'email' => $data['data']['email'],
                    'is_permanent_staff' => $data['data']['is_permanent_staff'] ?? false,
                    'type_of_appointment' => $data['data']['type_of_appointment'],
                    'appointed_on' => Carbon::parse($data['data']['appointed_on'])->toDateString(),
                    'assumed_duty_on' => Carbon::parse($data['data']['assumed_duty_on'])->toDateString()
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
                'salary_scale_id' => $data['data']['salary_scale_id'],
                'grade_level_id' => $data['data']['grade_level_id'],
                'grade_level_step_id' => $data['data']['grade_level_step_id'],
                'current_appointment' => Carbon::parse($data['data']['current_appointment'])->toDateString()
            ]);
        } else {
            $employeeJobProfile = EmployeeJobProfile::where('employee_id', $data['data']['id'])
                ->update([
                    'job_position_id' => $data['data']['job_position_id'],
                    'designation_id' => $data['data']['designation_id'],
                    'department_id' => $data['data']['department_id'],
                    'work_location_id' => $data['data']['work_location_id'],
                    'salary_scale_id' => $data['data']['salary_scale_id'],
                    'grade_level_id' => $data['data']['grade_level_id'],
                    'grade_level_step_id' => $data['data']['grade_level_step_id'],
                    'current_appointment' => Carbon::parse($data['data']['current_appointment'])->toDateString()
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
                'address_line_2' => $data['data']['address_line2'] ?? null,
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
                    'address_line_2' => $data['data']['address_line2'] ?? null,
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
        $employeeJob = EmployeeJobProfile::with('job_position.grade_level')->where('employee_id', $data['data']['id'])->first();
        $data['data']['status'] = AppConstant::PROGRESSION_STATUS_NEW;
        $gradeLevel = $employeeJob->job_position->grade_level;
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
        }else {
            $data['data']['expected_exit_date'] = Carbon::parse($data['data']['expected_exit_date'])->toDateString();
        }

        if (!isset($data['data']['is_confirmed'])) {
            $data['data']['is_confirmed'] = false;
        }
        if ($data['data']['is_confirmed'] == true) {
            $data['data']['status'] = AppConstant::PROGRESSION_STATUS_ACTIVE;
            $data['data']['confirmed_date'] = Carbon::now()->toDateString();
        }
        if (!isset($data['data']['is_exited'])) {
            $data['data']['is_exited'] = false;
        }
        if ($data['data']['is_exited'] == true) {
            $data['data']['actual_exit_date'] = Carbon::now()->toDateString();
            $data['data']['status'] = AppConstant::PROGRESSION_STATUS_RETIRE;
        }

        $data['data']['confirmation_due_date'] = isset($data['data']['confirmation_due_date']) ? Carbon::parse($data['data']['confirmation_due_date'])->toDateString() : null;
        $data['data']['last_increment'] = isset($data['data']['last_increment']) ? Carbon::parse($data['data']['last_increment'])->toDateString() : null;
        $data['data']['last_promoted'] = isset($data['data']['last_promoted']) ? Carbon::parse($data['data']['last_promoted'])->toDateString() : null;
        $data['data']['next_increment_due_date'] = Carbon::parse($employeeJob->current_appointment)->addMonths($data['data']['next_increment'])->toDateString();
        $data['data']['next_promotion_due_date'] = Carbon::parse($employeeJob->current_appointment)->addMonths($data['data']['next_promotion'])->toDateString();
        DB::beginTransaction();
        try {
            $progression = EmployeeProgression::where('employee_id', $data['data']['id'])->first();
            if (is_null($progression)) {
                $progression = EmployeeProgression::create([
                    'status' => $data['data']['status'],
                    'employee_id' => $data['data']['id'],
                    'confirmation_due_date' => $data['data']['confirmation_due_date'],
                    'month_increment' => $data['data']['next_increment'],
                    'month_promotion' => $data['data']['next_promotion'],
                    'confirmed_date' => $data['data']['confirmed_date'] ?? null,
                    'next_increment_due_date' => $data['data']['next_increment_due_date'],
                    'last_increment' => $data['data']['last_increment'],
                    'expected_exit_date' => $data['data']['expected_exit_date'],
                    'actual_exit_date' => $data['data']['actual_exit_date'] ?? null,
                    'next_promotion_due_date' => $data['data']['next_promotion_due_date'],
                    'last_promoted' => $data['data']['last_promoted'],
                ]);
            } else {
                $this->model = EmployeeProgression::class;
                $data['data']['month_promotion'] = $data['data']['next_promotion'];
                $data['data']['month_increment'] = $data['data']['next_increment'];
                $data['id'] = $progression->id;
                $progression = parent::update($data);
            }

            $data['data']['employee_id'] = $data['data']['id'];
            $this->model = EmployeePension::class;
            $employeePension = EmployeePension::where('employee_id', $data['data']['id']);
            $data['data']['date_started'] = isset($data['data']['date_started']) ? Carbon::parse($data['data']['date_started'])->toDateString() : null;
            if (is_null($employeePension->first())) {
                $employeePension = parent::create($data);
            } else {
                $data['id'] = $employeePension->first()->id;
                $employeePension = parent::update($data);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return array_merge($progression->toArray(), $employeePension->toArray());
    }


    public function setStatusForEmployee($data)
    {

        $emp = EmployeeProgression::whereIn('id', $data['data']['employee_ids'])->get();
        foreach ($data['data']['employee_ids'] as $employee_id) {
            /** @var EmployeeProgression $employeeProgression */
            $employeeProgression = EmployeeProgression::where('employee_id', $employee_id)->first();
            if ($data['data']['status'] == 'ACTIVE') {
                $employee = EmployeeProgression::where('employee_id', $employee_id)
                    ->update(['status' => AppConstant::PROGRESSION_STATUS_ACTIVE]);
            } elseif ($data['data']['status'] == 'CONFIRMED') {
                $employee = EmployeeProgression::where('employee_id', $employee_id)
                    ->update([
                        'confirmed_date' => Carbon::now()->toDateString()
                    ]);
            } elseif ($data['data']['status'] == 'INCREMENT') {
                $employee = EmployeeProgression::where('employee_id', $employee_id)
                    ->update([
                        'last_increment' => Carbon::now()->toDateString(),
                        'next_increment_due_date' => Carbon::parse($employeeProgression->next_increment_due_date)->addMonths($employeeProgression->month_increment)->toDateString()
                    ]);
            } elseif ($data['data']['status'] == 'PROMOTION') {
                $employee = EmployeeProgression::where('employee_id', $employee_id)
                    ->update([
                        'last_promoted' => Carbon::now()->toDateString(),
                        'next_promotion_due_date' => Carbon::parse($employeeProgression->next_promotion_due_date)->addMonths($employeeProgression->month_promotion)->toDateString()
                    ]);
            } elseif ($data['data']['status'] == 'RETIRE') {
                $employee = EmployeeProgression::where('employee_id', $employee_id)
                    ->update([
                        'status' => AppConstant::PROGRESSION_STATUS_RETIRE,
                        'actual_exit_date' => Carbon::now()->toDateString()
                    ]);
            }
        }

    }

    public function getAll($params = [], $query = null)
    {
        $query = Employee::query();
        if (isset($params['inputs']['department_id'])) {
            $query->whereHas('employee_job_profiles', function ($query) use ($params) {
                $query->where('department_id', $params['inputs']['department_id']);
            });
        }

        if (isset($params['inputs']['search'])) {
            $query->where('personnel_file_number', 'like', '%' . $params['inputs']['search'] . '%')
                ->orWhere('last_name', 'like', '%' . $params['inputs']['search'] . '%')
                ->orWhere('first_name', 'like', '%' . $params['inputs']['search'] . '%')
                ->orWhere('id', 'like', '%' . $params['inputs']['search'] . '%');
        }
        if (isset($params['inputs']['status'])) {
            if ($params['inputs']['status'] == AppConstant::PROGRESSION_STATUS_NEW) {
                $query->whereHas('employee_progressions', function ($query) {
                    $query->where('status', AppConstant::PROGRESSION_STATUS_NEW);
                    $query->whereNull('confirmed_date');
                });
            } elseif ($params['inputs']['status'] == AppConstant::PROGRESSION_STATUS_ACTIVE) {
                $query->whereHas('employee_progressions', function ($query) {
                    $query->where('status', AppConstant::PROGRESSION_STATUS_ACTIVE);
                });
            } elseif ($params['inputs']['status'] == AppConstant::PROGRESSION_STATUS_CONFIRMED) {
                $query->whereHas('employee_progressions', function ($query) {
                    $query->whereNotNull('confirmed_date');
                });
            } elseif ($params['inputs']['status'] == AppConstant::PROGRESSION_STATUS_CONFIRMATION_DUE) {
                $query->whereHas('employee_progressions', function ($query) {
                    $query->whereNull('confirmed_date');
                    $query->whereDate('confirmation_due_date', '<', Carbon::now()->toDateTimeString());
                });
            } elseif ($params['inputs']['status'] == AppConstant::PROGRESSION_STATUS_RETIREMENT_DUE) {
                $query->whereHas('employee_progressions', function ($query) {
                    $query->whereDate('expected_exit_date', '<', Carbon::now()->toDateTimeString());
                });
            } elseif ($params['inputs']['status'] == AppConstant::PROGRESSION_STATUS_INCREMENT_DUE) {
                $query->whereHas('employee_progressions', function ($query) {
                    $query->whereDate('next_increment_due_date', '<', Carbon::now()->toDateTimeString());
                });
            } elseif ($params['inputs']['status'] == AppConstant::PROGRESSION_STATUS_PROMOTION_DUE) {
                $query->whereHas('employee_progressions', function ($query) {
                    $query->whereDate('next_promotion_due_date', '<', Carbon::now()->toDateTimeString());
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
            'employee_job_profiles.emp_salary_scale',
            'employee_job_profiles.emp_grade_level',
            'employee_job_profiles.emp_grade_level_step',
            'employee_job_profiles.job_position',
            'employee_job_profiles.job_position.salary_scale',
            'employee_job_profiles.job_position.grade_level',
            'employee_job_profiles.job_position.grade_level_step',
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
        if (isset($data['data']['issued_date'])) {
            $data['data']['issued_date'] = Carbon::parse($data['data']['issued_date'])->toDateString();
        }
        if (isset($data['data']['expiry_date'])) {
            $data['data']['expiry_date'] = Carbon::parse($data['data']['expiry_date'])->toDateString();
        }
        $employeeIdno = EmployeeIdNo::where('employee_id', $data['data']['id']);
        if (is_null($employeeIdno->first())) {
            $employeeIdno = parent::create($data);
        } else {
            $data['id'] = $employeeIdno->first()->id;
            parent::update($data);
        }

        $this->model = EmployeeInternationalPassport::class;
        $employeePassport = EmployeeInternationalPassport::where('employee_id', $data['data']['id']);
        if (is_null($employeePassport->first())) {
            $employeePassport = parent::create($data);
        } else {
            $data['id'] = $employeePassport->first()->id;
            parent::update($data);
        }
        return array_merge($employeeIdno->first()->toArray(), $employeePassport->first()->toArray());
    }

    public function downloadReport($params)
    {
        $employees = $this->getAll($params)['items'];
        $headers = ['s.no', 'title', 'employee name', 'file number', 'staff', 'gender', 'marital status', 'department'];
        $data = null;

//        if (!isset($params['inputs']['columns'])) {
        foreach ($employees as $key => $employee) {
            $employee = $employee->toArray();
            $employeeData = [
                'serial_no' => $key + 1,
                'title' => $employee['title'],
                'employee_name' => $employee['first_name'] . ' ' . $employee['last_name'],
                'file_number' => $employee['personnel_file_number'],
                'staff_id' => $employee['id'],
                'gender' => $employee['employee_personal_details'] ? $employee['employee_personal_details']['gender'] : "-",
                'marital_status' => $employee['employee_personal_details'] ? $employee['employee_personal_details']['marital_status'] : '-',
                'department' => $employee['employee_job_profiles'] ? ($employee['employee_job_profiles']['department'] ?
                    $employee['employee_job_profiles']['department']['name'] : '-'
                ) : '-'];
            $data['employees'][] = $employeeData;
        }
//        } else {
//            $headers = json_decode($params['inputs']['columns'], true);
//dd(3);
//        }

        $filePath = 'csv/employee_report_' . \Carbon\Carbon::now()->format("Y-m-d_h:i:s") . '.csv';
        $file = fopen(public_path($filePath), 'w');

        fputcsv($file, $headers);
        foreach ($data['employees'] as $emp) {
            fputcsv($file, $emp);
        }
        fclose($file);
        return ['url' => url($filePath)];
    }


}

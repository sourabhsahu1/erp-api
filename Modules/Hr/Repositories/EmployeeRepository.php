<?php


namespace Modules\Hr\Repositories;


use App\Services\WKHTMLPDfConverter;
use App\Constants\AppConstant;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\Department;
use Modules\Hr\Models\Employee;
use Modules\Hr\Models\EmployeeContactDetail;
use Modules\Hr\Models\EmployeeIdNo;
use Modules\Hr\Models\EmployeeInternationalPassport;
use Modules\Hr\Models\EmployeeJobProfile;
use Modules\Hr\Models\EmployeePension;
use Modules\Hr\Models\EmployeePersonalDetail;
use Modules\Hr\Models\EmployeeProgression;
use Modules\Hr\Models\JobPosition;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;


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
                'country_code' => $data['data']['country_code'],
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
                    'country_code' => $data['data']['country_code'],
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
        } else {
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
//        if (isset($params['inputs']['department_id'])) {
//            $query->whereHas('employee_job_profiles', function ($query) use ($params) {
//                $query->whereHas('department', function ($query) use ($params) {
//                    $query->where('id', $params['inputs']['department_id'])
//                        ->orWhere('parent_id', $params['inputs']['department_id']);
//                });
//            });
//        }



        if (isset($params['inputs']['search'])) {
            $query->where('personnel_file_number', 'like', '%' . $params['inputs']['search'] . '%')
                ->orWhere('last_name', 'like', '%' . $params['inputs']['search'] . '%')
                ->orWhere('first_name', 'like', '%' . $params['inputs']['search'] . '%')
                ->orWhere('id', 'like', '%' . $params['inputs']['search'] . '%');
        }

        if (isset($params['inputs']['department_ids'])) {
            $query->whereHas('employee_job_profiles', function ($query) use ($params) {
                $query->whereHas('department', function ($query) use ($params) {
                    $query->whereIn('id', json_decode($params['inputs']['department_ids'], true));
                });
            });
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
            'employee_relatives',
            'employee_relatives.relative_job_profile',
            'employee_languages.language',
            'employee_academics.qualification',
            'employee_academics.academic',
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

//    public function downloadReport($params)
//    {
//        $employees = $this->getAll($params)['items'];
//        $headers = [
//            'SN' => 's.no',
//            'Title' => 'Title',
//            'File No' => 'File number',
//            'Staff ID' => 'Staff Id',
//            'Gender' => 'Gender',
//            'Marital Status' => 'Marital Status',
//            'Emp. Photo' => 'Emp. Photo',
//            'Expected Exit Date' => 'Expected Exit Date',
//            'Exited' => 'Exited',
//            'First Name' => 'First Name',
//            'Last Name' => 'Last Name',
//            'Type of Appointment' => 'Type of Appointment',
//            'TIN No' => 'TIN No',
//            'State' => 'State',
//            'PFA No' => 'PFA No',
//            'Salary Scale' => 'Salary Scale',
//            'Qualifications' => 'Qualifications',
//            'Permanent Staff' => 'Permanent Staff',
//            'Pension Started' => "Pension Started",
//            'Passport No' => "Passport No",
//            'Passport Issued on' => "Passport Issued on",
//            'Passport Issued at' => "Passport Issued at",
//            'Passport Expires on' => "Passport Expires on",
//            'NHF No' => "NHF No",
//            'National ID No' => "National ID No",
//            'Mobile Phone' => "Mobile Phone",
//            'Maiden Name' => "Maiden Name",
//            'Job Position' => "Job Position",
//            'Grade Level Step' => "Grade Level Step",
//            'Department' => "Department",
//            'Address' => "Address",
//            'Address Country' => "Address Country",
//            'Email' => "Email",
//            'Drivers Licence No' => "Drivers Licence No",
//            'Designation' => "Designation",
//            'Date Last Increment' => "Date Last Increment",
//            'Date Pension Started' => "Date Pension Started",
//            'Date of Birth' => "Date of Birth",
//            'Date Last Promoted' => "Date Last Promoted",
//            'Date Current Appt' => "Date Current Appt",
//            'Date Assumed Duty' => "Date Assumed Duty",
//            'Confirmed' => "Confirmed",
//            'City' => "City",
//            'Address State' => "Address State",
//            'Citizen Country' => "Citizen Country",
//            'Citizen LGA' => "Citizen LGA",
//            'Citizen Region' => "Citizen Region",
//            'Citizen State' => "Citizen State",
//            'Confirmation Due Date' => "Confirmation Due Date"
//        ];
//        $data = null;
//
//
//        if (!isset($params['inputs']['columns'])) {
//            foreach ($employees as $key => $employee) {
//                $employee = $employee->toArray();
//                $employeeData = [
//                    'serial_no' => $key + 1,
//                    'title' => $employee['title'],
//                    'employee_name' => $employee['first_name'] . ' ' . $employee['last_name'],
//                    'file_number' => $employee['personnel_file_number'],
//                    'staff_id' => $employee['id'],
//                    'gender' => $employee['employee_personal_details'] ? $employee['employee_personal_details']['gender'] : "-",
//                    'marital_status' => $employee['employee_personal_details'] ? $employee['employee_personal_details']['marital_status'] : '-',
//                    'phone' => $employee['employee_personal_details'] ? $employee['employee_personal_details']['phone'] : '-',
//                    'department' => $employee['employee_job_profiles'] ? ($employee['employee_job_profiles']['department'] ?
//                        $employee['employee_job_profiles']['department']['name'] : '-'
//                    ) : '-',
//                    'designation' => $employee['employee_job_profiles'] ? ($employee['employee_job_profiles']['department'] ?
//                        $employee['employee_job_profiles']['designation']['name'] : '-'
//                    ) : '-',
//                ];
//                $data['employees'][] = $employeeData;
//            }
//        } else {
//            $iHeader = json_decode($params['inputs']['columns'], true);
//            $iHeader = array_combine($iHeader, $iHeader);
//            $headers = array_intersect_key($headers, $iHeader);
//            foreach ($employees as $key => $employee) {
//                $employee = $employee->toArray();
//
//                $employeeData = [];
//                if (isset($headers['SN'])) {
//                    $employeeData = array_merge($employeeData, ['serial_no' => $key + 1]);
//                }
//                if (isset($headers['Title'])) {
//                    $employeeData = array_merge($employeeData, ['title' => $employee['title']]);
//                }
//                if (isset($headers['File No'])) {
//                    $employeeData = array_merge($employeeData, ['file_number' => $employee['personnel_file_number']]);
//                }
//                if (isset($headers['Staff ID'])) {
//                    $employeeData = array_merge($employeeData, ['staff_id' => $employee['id']]);
//                }
//                if (isset($headers['Gender'])) {
//                    $employeeData = $employeeData = array_merge($employeeData, [$employee['employee_personal_details'] ? $employee['employee_personal_details']['gender'] : "-"]);
//                }
//                if (isset($headers['Marital Status'])) {
//                    $employeeData = array_merge($employeeData, [$employee['employee_personal_details'] ? $employee['employee_personal_details']['marital_status'] : '-']);
//                }
//                if (isset($headers['Emp. Photo'])) {
//                    $employeeData = array_merge($employeeData, [$employee['file'] ? $employee['file']['url'] : '-']);
//                }
//                if (isset($headers['Expected Exit Date'])) {
//                    $employeeData = array_merge($employeeData, [
//                        'Expected Exit Date' => $employee['employee_progressions']
//                            ? ($employee['employee_progressions']['expected_exit_date'] ? $employee['employee_progressions']['expected_exit_date'] : null)
//                            : null]);
//                }
//                if (isset($headers['Exited'])) {
//                    $employeeData = array_merge($employeeData, ['Exited' => $employee['employee_progressions']['is_exited'] ?? null]);
//                }
//                if (isset($headers['First Name'])) {
//                    $employeeData = array_merge($employeeData, ['First Name' => $employee['first_name']]);
//                }
//                if (isset($headers['Last Name'])) {
//                    $employeeData = array_merge($employeeData, ['Last Name' => $employee['last_name']]);
//                }
//                if (isset($headers['Type of Appointment'])) {
//                    $employeeData = array_merge($employeeData, ['Type of Appointment' => $employee['employee_personal_details']['type_of_appointment'] ?? null ]);
//                }
//                if (isset($headers['TIN No'])) {
//                    $employeeData = array_merge($employeeData, ['TIN No' => $employee['employee_id_nos']['tin_number'] ?? null ]);
//                }
//                if (isset($headers['State'])) {
//                    $employeeData = array_merge($employeeData, ['State' => $employee['employee_contact_details']['state']['name'] ?? null ]);
//                }
//                if (isset($headers['PFA No'])) {
//                    $employeeData = array_merge($employeeData, ['PFA No' => $employee['employee_id_nos']['pfa_number'] ?? null ]);
//                }
//                if (isset($headers['Salary Scale'])) {
//                    $employeeData = array_merge($employeeData, ['Salary Scale' => $employee['employee_job_profiles']['emp_salary_scale']['name'] ?? null ]);
//                }
//                //todo
//                if (isset($headers['Qualifications'])) {
//                    $employeeData = array_merge($employeeData, ['Qualifications' => $employee['firsdt_name'] ?? null]);
//                }
//                if (isset($headers['Permanent Staff'])) {
//                    $employeeData = array_merge($employeeData, ['Permanent Staff' => $employee['employee_personal_details']['is_permanent_staff'] ?? null ]);
//                }
//                if (isset($headers['Pension Started'])) {
//                    $employeeData = array_merge($employeeData, ['Pension Started' => $employee['employee_pensions']['is_pension_started'] ?? null ]);
//                }
//
//                if (isset($headers['Passport No'])) {
//                    $employeeData = array_merge($employeeData, ['Passport No' => $employee['employee_international_passports']['passport_number'] ?? null ]);
//                }
//                if (isset($headers['Passport Issued on'])) {
//                    $employeeData = array_merge($employeeData, ['Passport Issued on' => $employee['employee_international_passports']['issued_date'] ?? null ]);
//                }
//                if (isset($headers['Passport Issued at'])) {
//                    $employeeData = array_merge($employeeData, ['Passport Issued at' => $employee['employee_international_passports']['issued_at'] ?? null ]);
//                }
//                if (isset($headers['Passport Expires on'])) {
//                    $employeeData = array_merge($employeeData, ['Passport Expires on' => $employee['employee_international_passports']['expiry_date'] ?? null ]);
//                }
//                if (isset($headers['NHF No'])) {
//                    $employeeData = array_merge($employeeData, ['NHF No' => $employee['employee_id_nos']['nhf_number'] ?? null ]);
//                }
//                if (isset($headers['National ID No'])) {
//                    $employeeData = array_merge($employeeData, ['National ID No' => $employee['employee_id_nos']['nhf_number'] ?? null ]);
//                }
//                if (isset($headers['Mobile Phone'])) {
//                    $employeeData = array_merge($employeeData, ['Mobile Phone' => $employee['employee_personal_details']['phone'] ?? null ]);
//                }
//                if (isset($headers['Maiden Name'])) {
//                    $employeeData = array_merge($employeeData, ['Maiden Name' => $employee['maiden_name'] ?? null ]);
//                }
//                if (isset($headers['Job Position'])) {
//                    $employeeData = array_merge($employeeData, ['Job Position' => $employee['employee_job_profiles']['job_position']['name'] ?? null ]);
//                }
//                if (isset($headers['Grade Level Step'])) {
//                    $employeeData = array_merge($employeeData, ['Grade Level Step' => $employee['employee_job_profiles']['job_position']['grade_level_step']['name'] ?? null ]);
//                }
//                if (isset($headers['Department'])) {
//                    $employeeData = array_merge($employeeData, ['Department' => $employee['employee_job_profiles']['department']['name'] ?? null ]);
//                }
//                if (isset($headers['Address'])) {
//                    $employeeData = array_merge($employeeData, ['Address' => $employee['employee_contact_details']['address_line_1'] ?? null ]);
//                }
//                if (isset($headers['Address Country'])) {
//                    $employeeData = array_merge($employeeData, ['Address Country' => $employee['employee_contact_details']['country']['name'] ?? null ]);
//                }
//                if (isset($headers['Email'])) {
//                    $employeeData = array_merge($employeeData, ['Email' => $employee['employee_personal_details']['email'] ?? null ]);
//                }
//                if (isset($headers['Drivers Licence No'])) {
//                    $employeeData = array_merge($employeeData, ['Drivers Licence No' => $employee['employee_id_nos']['driver_license_number'] ?? null ]);
//                }
//                if (isset($headers['Designation'])) {
//                    $employeeData = array_merge($employeeData, ['Designation' => $employee['employee_job_profiles']['designation']['name'] ?? null]);
//                }
//                if (isset($headers['Date Last Increment'])) {
//                    $employeeData = array_merge($employeeData, ['Date Last Increment' => $employee['employee_progressions']['last_increment'] ?? null ]);
//                }
//                if (isset($headers['Date Pension Started'])) {
//                    $employeeData = array_merge($employeeData, ['Date Pension Started' => $employee['employee_pensions']['date_started'] ?? null ]);
//                }
//                if (isset($headers['Date of Birth'])) {
//                    $employeeData = array_merge($employeeData, ['Date of Birth' => $employee['employee_personal_details']['date_of_birth'] ?? null ]);
//                }
//                if (isset($headers['Date Last Promoted'])) {
//                    $employeeData = array_merge($employeeData, ['Date Last Promoted' => $employee['employee_progressions']['last_promoted'] ?? null ]);
//                }
//                if (isset($headers['Date Current Appt'])) {
//                    $employeeData = array_merge($employeeData, ['Date Current Appt' => $employee['employee_job_profiles']['current_appointment'] ?? null ]);
//                }
//                if (isset($headers['Date Assumed Duty'])) {
//                    $employeeData = array_merge($employeeData, ['Date Assumed Duty' => $employee['employee_personal_details']['assumed_duty_on'] ?? null ]);
//                }
//                if (isset($headers['Confirmed'])) {
//                    $employeeData = array_merge($employeeData, ['Confirmed' => $employee['employee_progressions']['is_confirmed'] ?? null ]);
//                }
//                //todo
//                if (isset($headers['City'])) {
//                    $employeeData = array_merge($employeeData, ['City' => $employee['employee_contact_details']['address_line_2'] ?? null ]);
//                }
//                if (isset($headers['Address State'])) {
//                    $employeeData = array_merge($employeeData, ['Address State' => $employee['employee_contact_details']['state']['name'] ?? null ]);
//                }
//                if (isset($headers['Citizen Country'])) {
//                    $employeeData = array_merge($employeeData, ['Citizen Country' => $employee['employee_contact_details']['other_country']['name'] ?? null ]);
//                }
//                if (isset($headers['Citizen LGA'])) {
//                    $employeeData = array_merge($employeeData, ['Citizen LGA' => $employee['employee_contact_details']['other_lga']['name'] ?? null ]);
//                }
//                if (isset($headers['Citizen Region'])) {
//                    $employeeData = array_merge($employeeData, ['Citizen Region' => $employee['employee_contact_details']['other_region']['name'] ?? null ]);
//                }
//                if (isset($headers['Citizen State'])) {
//                    $employeeData = array_merge($employeeData, ['Citizen State' => $employee['employee_contact_details']['other_state']['name'] ?? null ]);
//                }
//                if (isset($headers['Confirmation Due Date'])) {
//                    $employeeData = array_merge($employeeData, ['Confirmation Due Date' => $employee['employee_progressions']['confirmation_due_date'] ?? null ]);
//                }
//                $data['employees'][] = $employeeData;
//            }
//
//        }
//
//        $filePath = 'csv/employee_report_' . \Carbon\Carbon::now()->format("Y-m-d_h:i:s") . '.csv';
//        $file = fopen(public_path($filePath), 'w');
//
//        fputcsv($file, $headers);
//        foreach ($data['employees'] as $emp) {
//            fputcsv($file, $emp);
//        }
//        fclose($file);
//        return ['url' => url($filePath)];
//    }

    public function downloadReport($params)
    {
        $employees = $this->getAll($params)['items'];
        $headers = [
            'SN' => 's.no',
            'Title' => 'Title',
            'File No' => 'File number',
            'Staff ID' => 'Staff Id',
            'Gender' => 'Gender',
            'Marital Status' => 'Marital Status',
            'Emp. Photo' => 'Emp. Photo',
            'Expected Exit Date' => 'Expected Exit Date',
            'Exited' => 'Exited',
            'First Name' => 'First Name',
            'Last Name' => 'Last Name',
            'Type of Appointment' => 'Type of Appointment',
            'TIN No' => 'TIN No',
            'State' => 'State',
            'PFA No' => 'PFA No',
            'Salary Scale' => 'Salary Scale',
            'Qualifications' => 'Qualifications',
            'Permanent Staff' => 'Permanent Staff',
            'Pension Started' => "Pension Started",
            'Passport No' => "Passport No",
            'Passport Issued on' => "Passport Issued on",
            'Passport Issued at' => "Passport Issued at",
            'Passport Expires on' => "Passport Expires on",
            'NHF No' => "NHF No",
            'National ID No' => "National ID No",
            'Mobile Phone' => "Mobile Phone",
            'Maiden Name' => "Maiden Name",
            'Job Position' => "Job Position",
            'Grade Level Step' => "Grade Level Step",
            'Department' => "Department",
            'Address' => "Address",
            'Address Country' => "Address Country",
            'Email' => "Email",
            'Drivers Licence No' => "Drivers Licence No",
            'Designation' => "Designation",
            'Date Last Increment' => "Date Last Increment",
            'Date Pension Started' => "Date Pension Started",
            'Date of Birth' => "Date of Birth",
            'Date Last Promoted' => "Date Last Promoted",
            'Date Current Appt' => "Date Current Appt",
            'Date Assumed Duty' => "Date Assumed Duty",
            'Confirmed' => "Confirmed",
            'City' => "City",
            'Address State' => "Address State",
            'Citizen Country' => "Citizen Country",
            'Citizen LGA' => "Citizen LGA",
            'Citizen Region' => "Citizen Region",
            'Citizen State' => "Citizen State",
            'Confirmation Due Date' => "Confirmation Due Date"
        ];
//        $headersIndex = array_values($headers);
        $data = null;


        if (!isset($params['inputs']['columns'])) {
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
                    'phone' => $employee['employee_personal_details'] ? $employee['employee_personal_details']['phone'] : '-',
                    'department' => $employee['employee_job_profiles'] ? ($employee['employee_job_profiles']['department'] ?
                        $employee['employee_job_profiles']['department']['name'] : '-'
                    ) : '-',
                    'designation' => $employee['employee_job_profiles'] ? ($employee['employee_job_profiles']['department'] ?
                        $employee['employee_job_profiles']['designation']['name'] : '-'
                    ) : '-',
                ];
                $data['employees'][] = $employeeData;
            }
        } else {
            $iHeader = json_decode($params['inputs']['columns'], true);
            $iHeader = array_combine($iHeader, $iHeader);
            $headers = array_intersect_key($headers, $iHeader);
            $headersIndex = array_values($headers);
            foreach ($employees as $key => $employee) {
                $employee = $employee->toArray();

                $employeeData = [];
                if (isset($headers['SN'])) {
                    $employeeData = array_merge($employeeData, ['serial_no' => $key + 1]);
                }
                if (isset($headers['Title'])) {
                    $employeeData = array_merge($employeeData, ['title' => $employee['title']]);
                }
                if (isset($headers['File No'])) {
                    $employeeData = array_merge($employeeData, ['file_number' => $employee['personnel_file_number']]);
                }
                if (isset($headers['Staff ID'])) {
                    $employeeData = array_merge($employeeData, ['staff_id' => $employee['id']]);
                }
                if (isset($headers['Gender'])) {
                    $employeeData = $employeeData = array_merge($employeeData, ['gender'=> $employee['employee_personal_details'] ? $employee['employee_personal_details']['gender'] : "-"]);
                }
                if (isset($headers['Marital Status'])) {
                    $employeeData = array_merge($employeeData, ['marital_status' => $employee['employee_personal_details'] ? $employee['employee_personal_details']['marital_status'] : '-']);
                }
                if (isset($headers['Emp. Photo'])) {
                    $employeeData = array_merge($employeeData, ['photo' =>$employee['file'] ? $employee['file']['local_path'] : null]);
                }
                if (isset($headers['Expected Exit Date'])) {
                    $employeeData = array_merge($employeeData, [
                        'Expected Exit Date' => $employee['employee_progressions']
                            ? ($employee['employee_progressions']['expected_exit_date'] ? $employee['employee_progressions']['expected_exit_date'] : null)
                            : null]);
                }
                if (isset($headers['Exited'])) {
                    $employeeData = array_merge($employeeData, ['Exited' => $employee['employee_progressions']['is_exited'] ?? null]);
                }
                if (isset($headers['First Name'])) {
                    $employeeData = array_merge($employeeData, ['First Name' => $employee['first_name']]);
                }
                if (isset($headers['Last Name'])) {
                    $employeeData = array_merge($employeeData, ['Last Name' => $employee['last_name']]);
                }
                if (isset($headers['Type of Appointment'])) {
                    $employeeData = array_merge($employeeData, ['Type of Appointment' => $employee['employee_personal_details']['type_of_appointment'] ?? null ]);
                }
                if (isset($headers['TIN No'])) {
                    $employeeData = array_merge($employeeData, ['TIN No' => $employee['employee_id_nos']['tin_number'] ?? null ]);
                }
                if (isset($headers['State'])) {
                    $employeeData = array_merge($employeeData, ['State' => $employee['employee_contact_details']['state']['name'] ?? null ]);
                }
                if (isset($headers['PFA No'])) {
                    $employeeData = array_merge($employeeData, ['PFA No' => $employee['employee_id_nos']['pfa_number'] ?? null ]);
                }
                if (isset($headers['Salary Scale'])) {
                    $employeeData = array_merge($employeeData, ['Salary Scale' => $employee['employee_job_profiles']['emp_salary_scale']['name'] ?? null ]);
                }
                //todo
                if (isset($headers['Qualifications'])) {
                    $employeeData = array_merge($employeeData, ['Qualifications' => $employee['firsdt_name'] ?? null]);
                }
                if (isset($headers['Permanent Staff'])) {
                    $employeeData = array_merge($employeeData, ['Permanent Staff' => $employee['employee_personal_details']['is_permanent_staff'] ?? null ]);
                }
                if (isset($headers['Pension Started'])) {
                    $employeeData = array_merge($employeeData, ['Pension Started' => $employee['employee_pensions']['is_pension_started'] ?? null ]);
                }

                if (isset($headers['Passport No'])) {
                    $employeeData = array_merge($employeeData, ['Passport No' => $employee['employee_international_passports']['passport_number'] ?? null ]);
                }
                if (isset($headers['Passport Issued on'])) {
                    $employeeData = array_merge($employeeData, ['Passport Issued on' => $employee['employee_international_passports']['issued_date'] ?? null ]);
                }
                if (isset($headers['Passport Issued at'])) {
                    $employeeData = array_merge($employeeData, ['Passport Issued at' => $employee['employee_international_passports']['issued_at'] ?? null ]);
                }
                if (isset($headers['Passport Expires on'])) {
                    $employeeData = array_merge($employeeData, ['Passport Expires on' => $employee['employee_international_passports']['expiry_date'] ?? null ]);
                }
                if (isset($headers['NHF No'])) {
                    $employeeData = array_merge($employeeData, ['NHF No' => $employee['employee_id_nos']['nhf_number'] ?? null ]);
                }
                if (isset($headers['National ID No'])) {
                    $employeeData = array_merge($employeeData, ['National ID No' => $employee['employee_id_nos']['nhf_number'] ?? null ]);
                }
                if (isset($headers['Mobile Phone'])) {
                    $employeeData = array_merge($employeeData, ['Mobile Phone' => $employee['employee_personal_details']['phone'] ?? null ]);
                }
                if (isset($headers['Maiden Name'])) {
                    $employeeData = array_merge($employeeData, ['Maiden Name' => $employee['maiden_name'] ?? null ]);
                }
                if (isset($headers['Job Position'])) {
                    $employeeData = array_merge($employeeData, ['Job Position' => $employee['employee_job_profiles']['job_position']['name'] ?? null ]);
                }
                if (isset($headers['Grade Level Step'])) {
                    $employeeData = array_merge($employeeData, ['Grade Level Step' => $employee['employee_job_profiles']['job_position']['grade_level_step']['name'] ?? null ]);
                }
                if (isset($headers['Department'])) {
                    $employeeData = array_merge($employeeData, ['Department' => $employee['employee_job_profiles']['department']['name'] ?? null ]);
                }
                if (isset($headers['Address'])) {
                    $employeeData = array_merge($employeeData, ['Address' => $employee['employee_contact_details']['address_line_1'] ?? null ]);
                }
                if (isset($headers['Address Country'])) {
                    $employeeData = array_merge($employeeData, ['Address Country' => $employee['employee_contact_details']['country']['name'] ?? null ]);
                }
                if (isset($headers['Email'])) {
                    $employeeData = array_merge($employeeData, ['Email' => $employee['employee_personal_details']['email'] ?? null ]);
                }
                if (isset($headers['Drivers Licence No'])) {
                    $employeeData = array_merge($employeeData, ['Drivers Licence No' => $employee['employee_id_nos']['driver_license_number'] ?? null ]);
                }
                if (isset($headers['Designation'])) {
                    $employeeData = array_merge($employeeData, ['Designation' => $employee['employee_job_profiles']['designation']['name'] ?? null]);
                }
                if (isset($headers['Date Last Increment'])) {
                    $employeeData = array_merge($employeeData, ['Date Last Increment' => $employee['employee_progressions']['last_increment'] ?? null ]);
                }
                if (isset($headers['Date Pension Started'])) {
                    $employeeData = array_merge($employeeData, ['Date Pension Started' => $employee['employee_pensions']['date_started'] ?? null ]);
                }
                if (isset($headers['Date of Birth'])) {
                    $employeeData = array_merge($employeeData, ['Date of Birth' => $employee['employee_personal_details']['date_of_birth'] ?? null ]);
                }
                if (isset($headers['Date Last Promoted'])) {
                    $employeeData = array_merge($employeeData, ['Date Last Promoted' => $employee['employee_progressions']['last_promoted'] ?? null ]);
                }
                if (isset($headers['Date Current Appt'])) {
                    $employeeData = array_merge($employeeData, ['Date Current Appt' => $employee['employee_job_profiles']['current_appointment'] ?? null ]);
                }
                if (isset($headers['Date Assumed Duty'])) {
                    $employeeData = array_merge($employeeData, ['Date Assumed Duty' => $employee['employee_personal_details']['assumed_duty_on'] ?? null ]);
                }
                if (isset($headers['Confirmed'])) {
                    $employeeData = array_merge($employeeData, ['Confirmed' => $employee['employee_progressions']['is_confirmed'] ?? null ]);
                }
                //todo
                if (isset($headers['City'])) {
                    $employeeData = array_merge($employeeData, ['City' => $employee['employee_contact_details']['address_line_2'] ?? null ]);
                }
                if (isset($headers['Address State'])) {
                    $employeeData = array_merge($employeeData, ['Address State' => $employee['employee_contact_details']['state']['name'] ?? null ]);
                }
                if (isset($headers['Citizen Country'])) {
                    $employeeData = array_merge($employeeData, ['Citizen Country' => $employee['employee_contact_details']['other_country']['name'] ?? null ]);
                }
                if (isset($headers['Citizen LGA'])) {
                    $employeeData = array_merge($employeeData, ['Citizen LGA' => $employee['employee_contact_details']['other_lga']['name'] ?? null ]);
                }
                if (isset($headers['Citizen Region'])) {
                    $employeeData = array_merge($employeeData, ['Citizen Region' => $employee['employee_contact_details']['other_region']['name'] ?? null ]);
                }
                if (isset($headers['Citizen State'])) {
                    $employeeData = array_merge($employeeData, ['Citizen State' => $employee['employee_contact_details']['other_state']['name'] ?? null ]);
                }
                if (isset($headers['Confirmation Due Date'])) {
                    $employeeData = array_merge($employeeData, ['Confirmation Due Date' => $employee['employee_progressions']['confirmation_due_date'] ?? null ]);
                }
                $data['employees'][] = $employeeData;
            }

        }

        $spreadsheet = new Spreadsheet();
        $activeSheet = $spreadsheet->getActiveSheet();


        foreach ($headersIndex as $index => $header) {
            $cellVal = self::toAlphabet($index) . 1;
            $activeSheet->setCellValue($cellVal, $header);
            $activeSheet->getStyle($cellVal)->getFont()->setBold(true);
        }

        $keyId = null;
        foreach ($data['employees'] as $index1 => $employee) {
            if (isset($employee['photo'])) {
              $keyId =  array_search("photo",array_keys($employee));
            }
            foreach (array_values($employee) as $index => $item) {
                $cellVal = self::toAlphabet($index) . ($index1+2);
                if (!is_null($keyId) && ($index == $keyId) && (!is_null($item))) {
                    $drawing = new Drawing();
                    $drawing->setPath($item);
                    $drawing->setCoordinates($cellVal);
                    $drawing->getShadow()->setDirection(45);
                    $drawing->setWidth(80);
                    $drawing->setHeight(80);
                    $drawing->setWorksheet($spreadsheet->getActiveSheet());
                    $activeSheet->getColumnDimension($index)->setWidth(20);
                }else{
                    $activeSheet->setCellValue($cellVal, $item);
                    $activeSheet->getStyle($cellVal)->getFont()->setBold(true);
                }

            }
        }

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filePath = 'csv/employee_report_' . \Carbon\Carbon::now()->format("Y-m-d_h:i:s") . '.xlsx';
        $writer->save($filePath);
        return ['url' => url($filePath)];
    }



    public static function toAlphabet($num)
    {

        $numeric = $num % 26;
        $letter = chr(65 + $numeric);
        $num2 = intval($num / 26);
        if ($num2 > 0) {
            return self::toAlphabet($num2 - 1) . $letter;
        } else {
            return $letter;
        }

    }

    public function downloadDetails($params)
    {
        $data = $this->show($params['inputs']['id'])->toArray();
        $parentDepartment = null;
        $jobPositionName = null;
        $parentGradeLevel = null;
        if (isset($data['employee_job_profiles']) && isset($data['employee_job_profiles']['department']) && isset($data['employee_job_profiles']['department']['parent_id'])) {
            $parentDepartmentId = $data['employee_job_profiles']['department']['parent_id'];

            $parentDepartment = Department::find($parentDepartmentId);
            if (!is_null($parentDepartment)) {
                $parentDepartment = $parentDepartment->name;
            }
        }

        if (isset($data['employee_job_profiles']) && isset($data['employee_job_profiles']['job_position']) && isset($data['employee_job_profiles']['job_position']['parent_id'])) {
            $parentJobPositionId = $data['employee_job_profiles']['job_position']['parent_id'];
            $jobPosition = JobPosition::with('grade_level')->find($parentJobPositionId);
            $jobPositionName = $jobPosition->name;
            $parentGradeLevel = $jobPosition->grade_level->name;
        }


        if (isset($data['employee_personal_details'])) {
            $data['yearsOfWork'] = Carbon::parse($data['employee_personal_details']['appointed_on'])->diffInYears(Carbon::now());
        }

        $data['parent_details'] = [
            'parent_department' => $parentDepartment,
            'parent_job_position' => $jobPositionName,
            'parent_grade_level' => $parentGradeLevel
        ];

       
        $fileName = 'employee-details' . \Carbon\Carbon::now()->toDateTimeString() . '.pdf';
        $filePath = "pdf/";
        if (strtolower($params['inputs']['type']) == 'short') {
            app()->make(WKHTMLPDfConverter::class)
                ->convert(view('reports.employee-short-report', ['data' => $data])->render(), $fileName);
        }
        if (strtolower($params['inputs']['type']) == 'extended') {
            app()->make(WKHTMLPDfConverter::class)
                ->convert(view('reports.employee-full-report', ['data' => $data])->render(), $fileName);
        }
        
        return ['url' => url($filePath . $fileName)];

    }


    public function downloadEmpDetails($params)
    {
        $data = $this->show($params['inputs']['id'])->toArray();
        $parentDepartment = null;
        $jobPositionName = null;
        $parentGradeLevel = null;
        if (isset($data['employee_job_profiles']) && isset($data['employee_job_profiles']['department']) && isset($data['employee_job_profiles']['department']['parent_id'])) {
            $parentDepartmentId = $data['employee_job_profiles']['department']['parent_id'];

            $parentDepartment = Department::find($parentDepartmentId);
            if (!is_null($parentDepartment)) {
                $parentDepartment = $parentDepartment->name;
            }
        }

        if (isset($data['employee_job_profiles']) && isset($data['employee_job_profiles']['job_position']) && isset($data['employee_job_profiles']['job_position']['parent_id'])) {
            $parentJobPositionId = $data['employee_job_profiles']['job_position']['parent_id'];
            $jobPosition = JobPosition::with('grade_level')->find($parentJobPositionId);
            $jobPositionName = $jobPosition->name;
            $parentGradeLevel = $jobPosition->grade_level->name;
        }


        if (isset($data['employee_personal_details'])) {
            $data['yearsOfWork'] = Carbon::parse($data['employee_personal_details']['appointed_on'])->diffInYears(Carbon::now());
        }

        $data['parent_details'] = [
            'parent_department' => $parentDepartment,
            'parent_job_position' => $jobPositionName,
            'parent_grade_level' => $parentGradeLevel
        ];


        $fileName = 'employee-details' . \Carbon\Carbon::now()->toDateTimeString() . '.pdf';
        $filePath = "pdf/";
        if (strtolower($params['inputs']['type']) == 'short') {
            app()->make(WKHTMLPDfConverter::class)
                ->convertBrowserShot(view('reports.employee-short-report', ['data' => $data])->render(), $fileName);
        }
        if (strtolower($params['inputs']['type']) == 'extended') {
            app()->make(WKHTMLPDfConverter::class)
                ->convertBrowserShot(view('reports.employee-full-report', ['data' => $data])->render(), $fileName);
        }

        return ['url' => url($filePath . $fileName)];

    }
}

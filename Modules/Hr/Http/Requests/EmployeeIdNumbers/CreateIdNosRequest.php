<?php


namespace Modules\Hr\Http\Requests\EmployeeIdNumbers;


use Illuminate\Validation\Rule;
use Luezoid\Laravelcore\Requests\BaseRequest;
use Modules\Hr\Models\EmployeeIdNo;
use Modules\Hr\Models\EmployeeInternationalPassport;

class CreateIdNosRequest extends BaseRequest
{

    public function rules()
    {
        $id = $this->route('id');
        $idNosId = EmployeeIdNo::where('employee_id', $id)->first();
        $passwordId = EmployeeInternationalPassport::where('employee_id', $id)->first();;
        return [
            'nhfNumber' => ["required", Rule::unique('hr_employee_id_nos', 'nhf_number')->ignore($idNosId)],
            'tinNumber' => ["required", Rule::unique('hr_employee_id_nos', 'tin_number')->ignore($idNosId)],
            'driverLicenseNumber' => ["required", Rule::unique('hr_employee_id_nos', 'driver_license_number')->ignore($idNosId)],
            'bankVersionNumber' => ["required", Rule::unique('hr_employee_id_nos', 'bank_version_number')->ignore($idNosId)],
            'pensionFundAdministration' => ["required"],
            'nationalIdNumber' => ["required", Rule::unique('hr_employee_id_nos', 'national_id_number')->ignore($idNosId)],
            'payrollPin' => ["required", Rule::unique('hr_employee_id_nos', 'payroll_pin')->ignore($idNosId)],
            'pfaNumber' => ["required"],
            'isForeignEmployee' => ['required', 'boolean'],
            'passportNumber' => ["required_if:isForeignEmployee,true", Rule::unique('hr_employee_international_passport', 'passport_number')->ignore($passwordId)],
            'issuedAt' => ["required_if:isForeignEmployee,true","exists:countries,id"],
            'issuedDate' => ["required_if:isForeignEmployee,true","date"],
            'expiryDate' => ["required_if:isForeignEmployee,true", function ($a, $v, $f) {
                $issueDate = $this->get('issuedDate');
                if (strtotime($issueDate) > strtotime($v)) {
                    return $f('expiry date cannot be earlier than issue date');
                }
            }],
            'workPermitNumber' => ["required_if:isForeignEmployee,true", Rule::unique('hr_employee_international_passport', 'work_permit_number')->ignore($passwordId)]
        ];
    }
}

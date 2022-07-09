<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('authenticate', "AuthenticationController@doLogin")->name('authenticate.store');
Route::middleware(['auth:api'])->group(function () {
    Route::get('self', 'AuthenticationController@getSelfData')->name('self.index');
    /*Master Apis*/
    Route::resource('departments', 'DepartmentController');
    Route::resource('designations', 'DesignationController');
    Route::resource('skills', 'SkillsController');
    Route::resource('qualifications', 'QualificationController');
    Route::resource('countries', 'CountryController');
    Route::resource('regions', 'RegionController');
    Route::resource('states', 'StateController');
    Route::resource('lgas', 'LgaController');
    Route::resource('lgas', 'LgaController');
    Route::get('locations', 'CountryController@getAllLocations');
    Route::resource('languages', 'LanguageController');
    Route::resource('schedules', 'ScheduleController');
    Route::resource('academics', 'AcademicsController');
    Route::resource('relationships', 'RelationshipController');
    Route::resource('categories', 'CategoryController');
    Route::resource('status', 'StatusController');
    Route::resource('disengagements', 'DisengagementController');
    Route::resource('censures', 'CensureController');
    Route::resource('arm-of-services', 'ArmOfServiceController');
    Route::resource('memberships', 'MembershipController');
    Route::resource('work-locations', 'WorkLocationController');

    /*Salary scale and grade Level*/
    Route::resource('salary-scales', 'SalaryScaleController');
    Route::get('grade-levels/{id}', 'GradeLevelController@show');
    Route::get('grade-levels', 'GradeLevelController@index');
    Route::post('grade-levels', 'GradeLevelController@store');
    Route::put('grade-levels/{id}', 'GradeLevelController@update');
    Route::delete('grade-levels/{id}', 'GradeLevelController@destroy');
    Route::post('grade-levels-steps', 'GradeLevelStepController@store');
    Route::put('grade-levels-steps/{id}', 'GradeLevelStepController@update');
    Route::delete('grade-levels-steps/{id}', 'GradeLevelStepController@destroy');
    Route::get('grade-levels-steps/{id}', 'GradeLevelStepController@show');

    Route::resource('job-positions', 'JobPositionController');
    Route::resource('leaves', 'LeaveController');
    Route::resource('leave-groups', 'LeaveGroupController');
    Route::resource('leave-group-members', 'LeaveGroupMemberController');
    Route::resource('leave-group-entitlements', 'LeaveGroupEntitlementController');
    Route::resource('leave-entitlement-salary-scales', 'LeaveSalaryScaleEntitlementController');
    Route::resource('leave-entitlement-grade-levels', 'LeaveGradeLevelEntitlementController');
    Route::resource('leave-years', 'LeaveYearController');
    Route::resource('leave-requests', 'LeaveRequestController');
    Route::resource('leave-requests-closed', 'LeaveRequestClosedController');
    Route::resource('hr-informations', 'HrInformationController');
    Route::resource('leave-credits', 'LeaveCreditController');
    Route::post('bulk-upload-leave-credits', 'LeaveCreditController@BulkUpload');
    Route::delete('delete-all-leave-credits', 'LeaveCreditController@DeleteAllLeaveCredits');
    Route::get('leave-credits-view', 'LeaveCreditController@LeaveCreditView');
    Route::resource('public-holidays', 'PublicHolidayController');

    /*Employees*/
    Route::delete('employees/{id}', 'EmployeeController@destroy');
    Route::post('employees', 'EmployeeController@store');
    Route::put('employees/{id}', 'EmployeeController@update');
    Route::post('employees/{id}/details', 'EmployeeController@employeeDetails');
    Route::post('employees/{id}/job-profile', 'EmployeeController@jobProfile');
    Route::resource('employees-job-profiles', 'JobProfileController');
    Route::post('employees/{id}/location', 'EmployeeController@location');
    Route::post('employees/{id}/progression', 'EmployeeController@employeeProgression');
    Route::post('employees/status', 'EmployeeController@setStatusForEmployee');
    Route::get('employees', 'EmployeeController@index');
    Route::get('employees/report-download', 'EmployeeController@downloadReport');
    Route::get('employees/{id}', 'EmployeeController@show');
    Route::post('employees/{id}/pension', 'EmployeeController@employeePension');
    Route::post('employees/{id}/id-nos', 'EmployeeController@employeeIdNos');
    Route::post('employees/{id}/passport', 'EmployeeController@employeePassport');

    Route::get('marriages', 'ConstantApiController@getMarriageData');
    Route::get('religions', 'ConstantApiController@getReligions');
    Route::get('type-of-appointments', 'ConstantApiController@getTypeOfAppointments');
    //    Route::get('banks', 'ConstantApiController@getBanks');
    Route::get('bank/{id}/branches', 'ConstantApiController@getBranches');

    Route::resource('address-type', 'AddressTypeController');
    Route::resource('phone-type', 'PhoneNumberTypeController');
    
    //Leave Reports
    Route::resource('leave-balance-report', 'LeaveBalanceReportController');
    Route::resource('leave-schedule-report', 'LeaveScheduleReportController');
    Route::resource('leave-request-report', 'LeaveRequestReportController');

    /*employee bank details*/
    Route::get('employee/{employeeId}/banks', 'EmployeeBankDetailController@index');
    Route::get('employee/{employeeId}/banks/{id}', 'EmployeeBankDetailController@show');
    Route::post('employee/{employeeId}/banks', 'EmployeeBankDetailController@store');
    Route::put('employee/{employeeId}/banks/{id}', 'EmployeeBankDetailController@update');
    Route::delete('employee-banks/{id}', 'EmployeeBankDetailController@destroy');

    /*employee addresses*/
    Route::get('employee/{employeeId}/addresses', 'EmployeeAddressController@index');
    Route::get('employee/{employeeId}/addresses/{id}', 'EmployeeAddressController@show');
    Route::post('employee/{employeeId}/addresses', 'EmployeeAddressController@store');
    Route::put('employee/{employeeId}/addresses/{id}', 'EmployeeAddressController@update');
    Route::delete('employee-addresses/{id}', 'EmployeeAddressController@destroy');

    /*employee background*/
    Route::get('employee/{employeeId}/background', 'EmployeeBackGroundController@index');
    Route::get('employee/{employeeId}/background/{id}', 'EmployeeBackGroundController@show');
    Route::post('employee/{employeeId}/background', 'EmployeeBackGroundController@store');
    Route::put('employee/{employeeId}/background/{id}', 'EmployeeBackGroundController@update');
    Route::delete('employee-background/{id}', 'EmployeeBackGroundController@destroy');

    /*employee censure*/
    Route::get('employee/{employeeId}/censures', 'EmployeeCensureController@index');
    Route::get('employee/{employeeId}/censures/{id}', 'EmployeeCensureController@show');
    Route::post('employee/{employeeId}/censures', 'EmployeeCensureController@store');
    Route::put('employee/{employeeId}/censures/{id}', 'EmployeeCensureController@update');
    Route::delete('employee-censures/{id}', 'EmployeeCensureController@destroy');

    /*employee language*/
    Route::get('employee/{employeeId}/languages', 'EmployeeLanguageController@index');
    Route::get('employee/{employeeId}/languages/{id}', 'EmployeeLanguageController@show');
    Route::post('employee/{employeeId}/languages', 'EmployeeLanguageController@store');
    Route::put('employee/{employeeId}/languages/{id}', 'EmployeeLanguageController@update');
    Route::delete('employee-languages/{id}', 'EmployeeLanguageController@destroy');

    /*employee membership*/
    Route::get('employee/{employeeId}/memberships', 'EmployeeMembershipController@index');
    Route::get('employee/{employeeId}/memberships/{id}', 'EmployeeMembershipController@show');
    Route::post('employee/{employeeId}/memberships', 'EmployeeMembershipController@store');
    Route::put('employee/{employeeId}/memberships/{id}', 'EmployeeMembershipController@update');
    Route::delete('employee-memberships/{id}', 'EmployeeMembershipController@destroy');


    /*employee military*/
    Route::get('employee/{employeeId}/military', 'EmployeeMilitaryServiceController@index');
    Route::get('employee/{employeeId}/military/{id}', 'EmployeeMilitaryServiceController@show');
    Route::post('employee/{employeeId}/military', 'EmployeeMilitaryServiceController@store');
    Route::put('employee/{employeeId}/military/{id}', 'EmployeeMilitaryServiceController@update');
    Route::delete('employee-military/{id}', 'EmployeeMilitaryServiceController@destroy');

    /*employee phones*/
    Route::get('employee/{employeeId}/phones', 'EmployeePhoneController@index');
    Route::get('employee/{employeeId}/phones/{id}', 'EmployeePhoneController@show');
    Route::post('employee/{employeeId}/phones', 'EmployeePhoneController@store');
    Route::put('employee/{employeeId}/phones/{id}', 'EmployeePhoneController@update');
    Route::delete('employee-phones/{id}', 'EmployeePhoneController@destroy');

    /*employee qualifications*/
    Route::get('employee/{employeeId}/qualifications', 'EmployeeQualificationController@index');
    Route::get('employee/{employeeId}/qualifications/{id}', 'EmployeeQualificationController@show');
    Route::post('employee/{employeeId}/qualifications', 'EmployeeQualificationController@store');
    Route::put('employee/{employeeId}/qualifications/{id}', 'EmployeeQualificationController@update');
    Route::delete('employee-qualifications/{id}', 'EmployeeQualificationController@destroy');

    /*employee relations*/
    Route::get('employee/{employeeId}/relations', 'EmployeeRelationController@index');
    Route::get('employee/{employeeId}/relations/{id}', 'EmployeeRelationController@show');
    Route::post('employee/{employeeId}/relations', 'EmployeeRelationController@store');
    Route::put('employee/{employeeId}/relations/{id}', 'EmployeeRelationController@update');
    Route::delete('employee-relations/{id}', 'EmployeeRelationController@destroy');

    /*employee schools*/
    Route::get('employee/{employeeId}/schools', 'EmployeeSchoolController@index');
    Route::get('employee/{employeeId}/schools/{id}', 'EmployeeSchoolController@show');
    Route::post('employee/{employeeId}/schools', 'EmployeeSchoolController@store');
    Route::put('employee/{employeeId}/schools/{id}', 'EmployeeSchoolController@update');
    Route::delete('employee-schools/{id}', 'EmployeeSchoolController@destroy');

    /*employee histories*/
    Route::get('employee/{employeeId}/histories', 'EmploymentHistoryController@index');
    Route::get('employee/{employeeId}/histories/{id}', 'EmploymentHistoryController@show');
    Route::post('employee/{employeeId}/histories', 'EmploymentHistoryController@store');
    Route::put('employee/{employeeId}/histories/{id}', 'EmploymentHistoryController@update');
    Route::delete('employee-histories/{id}', 'EmploymentHistoryController@destroy');

    /*employee progression history*/
    Route::get('employee/{employeeId}/progression-history', 'EmployeeProgressionController@index');
    Route::post('employee/{employeeId}/progression-history', 'EmployeeProgressionController@store');
    Route::put('employee/{employeeId}/progression-history/{id}', 'EmployeeProgressionController@update');

    /*employee login*/
    Route::post('employee-login-access/{employeeId}', 'EmployeeController@employeeLoginCreate');
});
Route::get('employee/{id}/details-download', 'EmployeeController@downloadDetails');
Route::get('employee/{id}/emp-details-download', 'EmployeeController@downloadEmpDetails');
Route::get('country-codes', 'ConstantApiController@getCountryCodes');

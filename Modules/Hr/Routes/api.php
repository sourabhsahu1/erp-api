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
    Route::resource('countries','CountryController');
    Route::resource('regions','RegionController');
    Route::resource('states','StateController');
    Route::resource('lgas','LgaController');
    Route::get('locations', 'CountryController@getAllLocations');
    Route::resource('languages','LanguageController');
    Route::resource('schedules','ScheduleController');
    Route::resource('academics','AcademicsController');
    Route::resource('relationships','RelationshipController');
    Route::resource('categories','CategoryController');
    Route::resource('status','StatusController');
    Route::resource('disengagements','DisengagementController');
    Route::resource('censures','CensureController');
    Route::resource('arm-of-services','ArmOfServiceController');
    Route::resource('memberships','MembershipController');
    Route::resource('work-locations', 'WorkLocationController');

    /*Salary scale and grade Level*/
    Route::resource('salary-scales','SalaryScaleController');
    Route::get('grade-levels/{id}','GradeLevelController@show');
    Route::post('grade-levels','GradeLevelController@store');
    Route::put('grade-levels/{id}','GradeLevelController@update');
    Route::delete('grade-levels/{id}','GradeLevelController@destroy');
    Route::post('grade-levels-steps','GradeLevelStepController@store');
    Route::put('grade-levels-steps/{id}','GradeLevelStepController@update');
    Route::delete('grade-levels-steps/{id}','GradeLevelStepController@destroy');
    Route::get('grade-levels-steps/{id}','GradeLevelStepController@show');

    Route::resource('job-positions','JobPositionController');
    Route::resource('leaves','LeaveController');
    Route::resource('leave-groups','LeaveGroupController');
    Route::resource('public-holidays','PublicHolidayController');

    /*Employees*/
    Route::post('employees','EmployeeController@store');
    Route::put('employees/{id}','EmployeeController@update');
    Route::post('employees/{id}/details','EmployeeController@employeeDetails');
    Route::post('employees/{id}/job-profile','EmployeeController@jobProfile');
    Route::post('employees/{id}/location','EmployeeController@location');
    Route::post('employees/{id}/progression','EmployeeController@employeeProgression');
});

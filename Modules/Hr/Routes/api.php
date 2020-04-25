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
    Route::resource('departments', 'DepartmentController');
    Route::resource('designations', 'DesignationController');
    Route::resource('skills', 'SkillsController');
    Route::resource('qualifications', 'QualificationController');
    Route::resource('countries','CountryController');
    Route::resource('regions','RegionController');
    Route::resource('states','StateController');
    Route::resource('lgas','LgaController');
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
    Route::get('self', 'AuthenticationController@getSelfData')->name('self.index');
    Route::get('locations', 'CountryController@getAllLocations');
});
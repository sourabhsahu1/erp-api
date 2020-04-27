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
Route::middleware([])->group(function () {
    Route::resource('departments', 'DepartmentController');
    Route::resource('designations', 'DesignationController');
    Route::resource('skills', 'SkillsController');
    Route::resource('qualifications', 'QualificationController');
    Route::get('self', 'AuthenticationController@getSelfData')->name('self.index');
});

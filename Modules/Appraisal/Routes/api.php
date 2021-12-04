<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use Modules\Appraisal\http\Controller\EmployeeAppraisalController;


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

Route::middleware('auth:api')->get('/appraisal', function (Request $request) {
    return $request->user();
});

Route::get('/appraisal/{row_num?}', 'AppraisalController@index');
Route::put('/appraisal/{id}', 'AppraisalController@update');
Route::delete('/appraisal/{id}', 'AppraisalController@destroy');
Route::get('/appraisal/{id}', 'AppraisalController@show');


Route::get('confirmappraisal/{row_num?}', 'ConfirmAppraisalController@index')->middleware('auth:api');
Route::get('confirmappraisal/{id}', 'ConfirmAppraisalController@show');
Route::post('confirmappraisal/{fileno}', 'ConfirmAppraisalController@store')->middleware('auth:api');
Route::put('confirmappraisal/{id}/{fileno}', 'ConfirmAppraisalController@update');
Route::delete('confirmappraisal/{id}', 'ConfirmAppraisalController@delete');

Route::get('superviseappraisal/{row_num?}', 'SupervisorsAppraisalController@index')->middleware('auth:api');
Route::get('superviseappraisal/{id}', 'SupervisorsAppraisalController@show');
Route::post('superviseappraisal/{fileno}', 'SupervisorsAppraisalController@store')->middleware('auth:api');
Route::put('superviseappraisal/{id}/{fileno}', 'SupervisorsAppraisalController@update');
Route::delete('superviseappraisal/{id}', 'SupervisorsAppraisalController@delete');
Route::post('superviseappraisal/assign', 'SupervisorsAppraisalController@supervisorAssignment')->middleware('auth:api');

Route::get('/employeeappraisal/{row_num?}', 'EmployeeAppraisalController@index')->middleware('auth:api');
Route::get('/employeeappraisal/{id}', 'EmployeeAppraisalController@show')->middleware('auth:api');
Route::post('/employeeappraisal', 'EmployeeAppraisalController@store');
Route::put('employeeappraisal/{id}', 'EmployeeAppraisalController@update');
Route::delete('employeeappraisal/{id}', 'EmployeeAppraisalController@delete');
Route::post('employeeappraisal/assign', 'EmployeeAppraisalController@supervisorAssignment')->middleware('auth:api');

Route::get('/employeeAppraisal/{row_num}/{fileno}', 'EmployeeAppraisalController@EmployeeAppraisal');

Route::get('/disputeappraisal/{row_num?}', 'DisputeAppraisalController@index');
Route::get('/disputeappraisal/{id}', 'DisputeAppraisalController@show');
Route::post('/disputeappraisal', 'DisputeAppraisalController@store');
Route::put('/disputeappraisal/{id}', 'DisputeAppraisalController@update');
Route::delete('/disputeappraisal/{id}', 'DisputeAppraisalController@delete');



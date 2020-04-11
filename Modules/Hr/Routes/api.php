<?php

use Illuminate\Http\Request;

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

Route::get('employees', 'EmployeeController@index');
Route::post('employees', 'EmployeeController@store');
Route::get('employees/{id}', 'EmployeeController@show');
Route::delete('employees', 'EmployeeController@destroy');
Route::put('employees/{id}', 'EmployeeController@destroy');
Route::get('employees/{id}/custom-get', 'EmployeeController@customGet');
Route::post('employees/{id}/custom-post', 'EmployeeController@customPost');

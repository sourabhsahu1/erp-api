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
    Route::resource('admin', 'AdminController', ['parameters' => ['admin' => 'id']]);
    Route::resource('users', 'UserController');
    Route::get('roles', 'RoleController@index');
    Route::post('user/{id}/role', 'UserController@addRoleAssign');
    Route::put('user/{id}/role', 'UserController@updateRoleAssign');
    Route::delete('user/{id}/role/{roleId}', 'UserController@deleteRoleAssign');
    Route::put('profile', 'UserController@userProfileUpdate');
    Route::post('admin-segments/{id}/levels', 'AdminController@levels');
    Route::resource('companies','CompanyController');

    Route::get('company/{companyId}/bank','CompanyBankController@index');
    Route::post('company/{companyId}/bank','CompanyBankController@store');
    Route::put('company/{companyId}/bank/{id}','CompanyBankController@update');
    Route::delete('company/{companyId}/bank/{id}','CompanyBankController@destroy');

    Route::resource('taxes','TaxController');
});


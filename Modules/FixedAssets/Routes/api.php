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

Route::middleware('auth:api')->get('/fixedassets', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:api'])->prefix('fixed-assets')->group(function () {
    Route::resource('categories', 'FxaCategoriesController');
    Route::get('statuses', 'FixAssetStatusController@index');
    Route::get('depreciations', 'FixAssetDepreciationController@index');
    Route::resource('', 'FixedAssetsController');
    Route::get('{id}', 'FixedAssetsController@show');
    Route::delete('{id}', 'FixedAssetsController@destroy');
    Route::put('{id}', 'FixedAssetsController@updateOverloadFunction');
    Route::get('{fxa_asset_id}/deployments', 'FixedAssetDeploymentsController@index');
    Route::post('re-deployments', 'FixedAssetDeploymentsController@store');
    Route::post('depreciations', 'FixAssetDepreciationController@store');
});

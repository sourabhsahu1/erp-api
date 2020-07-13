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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('files', '\Luezoid\Laravelcore\Http\Controllers\FileController@store')
    ->name('files.store');


\Illuminate\Routing\Route::get('download-file', function (Request $request) {
    $fileId = $request->get('fileId');
    /** @var \Adapt\Models\File $file */
    $file = \Adapt\Models\File::find($fileId);
    return response()->download(public_path() . $file->local_path, $file->name);
});

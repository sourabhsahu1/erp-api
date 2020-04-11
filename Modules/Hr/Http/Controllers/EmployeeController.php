<?php


namespace Modules\Hr\Http\Controllers;


use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Luezoid\Laravelcore\Jobs\BaseJob;
use Modules\Hr\Http\Requests\Employee\CreateRequest;
use Modules\Hr\Repositories\EmployeeRepository;

class EmployeeController extends BaseController
{


    protected $repository = EmployeeRepository::class;

    protected $storeJobMethod = "create";
    protected $createJob = BaseJob::class;
    protected $storeRequest = CreateRequest::class;

    protected $updateJobMethod = "update";

    protected $updateJob = BaseJob::class;
    protected $updateRequest = BaseJob::class;


    public function customGet(Request $request)
    {
        $this->jobMethod = "customGet";
        return $this->handleCustomEndPointGet(BaseJob::class, $request);
    }

    public function customPost(Request $request)
    {
        $this->jobMethod = "customPost1";
        return $this->handleCustomEndPoint(BaseJob::class, $request);
    }

//
//Route::get('employees', 'EmployeeController@index');
//Route::post('employees', 'EmployeeController@store');
//Route::get('employees/{id}', 'EmployeeController@show');
//Route::delete('employees', 'EmployeeController@destroy');
//Route::put('employees/{id}', 'EmployeeController@destroy');
//Route::get('employees/{id}/custom-get', 'EmployeeController@customGet');
//Route::post('employees/{id}/custom-get', 'EmployeeController@customPost');


}

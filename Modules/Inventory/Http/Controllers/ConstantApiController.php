<?php


namespace Modules\Inventory\Http\Controllers;


use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\DB;

class ConstantApiController extends BaseController
{

    public function getConfig() {
        $data['data']['items'] = DB::table('company_config')->get();
        return $data;
    }
}

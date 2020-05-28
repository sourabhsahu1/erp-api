<?php


namespace Modules\Hr\Http\Controllers;


use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Modules\Hr\Models\Bank;
use Modules\Hr\Models\BankBranch;
use Modules\Hr\Models\Marriage;
use Modules\Hr\Models\Religion;
use Modules\Hr\Models\TypeOfAppointment;

class ConstantApiController extends BaseController
{

    public function getMarriageData() {
       $data['data']['items'] = Marriage::get();
       return $data;
    }

    public function getTypeOfAppointments() {
       $data['data']['items'] = TypeOfAppointment::get();
       return $data;
    }

    public function getReligions() {
       $data['data']['items'] = Religion::get();
       return $data;
    }

    public function getBanks() {
        $data['data']['items'] = Bank::get();
        return $data;
    }

    public function getBranches(Request $request) {
        $id = $request->route('id');;

        $data['data']['items'] = BankBranch::where('bank_id', $id)->get();
        return $data;
    }

}

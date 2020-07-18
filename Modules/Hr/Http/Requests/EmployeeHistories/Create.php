<?php


namespace Modules\Hr\Http\Requests\EmployeeHistories;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{
    public function rules()
    {
        return [
            'employer' => "required",
            'engaged'=> ['required', 'date', function($a,$v,$f){
                if (strtotime($this->get('disengaged')) < strtotime($v)) {
                    return $f("engaged date cannot be greater than disengaged date");
                }
            }],
            'disengaged'=> "required",
            'totalRemuneration'=> "required",
            'filePage'=> "required"
        ];
    }

}

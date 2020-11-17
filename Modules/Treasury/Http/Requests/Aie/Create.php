<?php


namespace Modules\Treasury\Http\Requests\Aie;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Create extends BaseRequest
{

    public function rules()
    {
        return [
            'aieNumber' => 'required',
            'dateIssued' => 'required',
            'narration' => 'required',
            'fundSegmentId' => 'required',
            'adminSegmentId' => 'required'
        ];
    }
}

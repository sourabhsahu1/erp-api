<?php


namespace Modules\Treasury\Http\Requests\Aie;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Update extends BaseRequest
{

    public function rules()
    {
        return [
            'aieNumber' => 'sometimes',
            'dateIssued' => 'sometimes',
            'narration' => 'sometimes',
            'fundSegmentId' => 'sometimes',
            'adminSegmentId' => 'sometimes'
        ];
    }
}

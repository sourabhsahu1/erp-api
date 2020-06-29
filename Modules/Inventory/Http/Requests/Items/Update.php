<?php


namespace Modules\Inventory\Http\Requests\Items;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Update  extends BaseRequest
{

    public function rules()
    {
        return [
            'categoryId' => 'required|exists:inventory_categories,id',
            'measurementId' => 'required_if:isNotPhysicalQuantity,0',
            'description' => 'required',
            'partNumber' => 'required',
            'isNotPhysicalQuantity' => 'required|boolean',
//            'isChargedVat' => 'required|boolean',
//            'isChargedOtherTax' => 'required|boolean',
            'isTaxApplicable' => 'required|boolean',
            'unitPrice' => 'required|integer',
            'salesCommission' => 'required|integer',
            'leadDays' => 'required|integer',
            'reorderQuantity' => 'required|integer',
            'minimumQuantity' => 'required|integer',
            'maximumQuantity' => 'required|integer'
        ];
    }
}

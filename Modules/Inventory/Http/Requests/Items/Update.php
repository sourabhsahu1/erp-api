<?php


namespace Modules\Inventory\Http\Requests\Items;


use Luezoid\Laravelcore\Requests\BaseRequest;

class Update  extends BaseRequest
{

    public function rules()
    {
        return [
            'categoryId' => 'required|exists:inventory_categories,id',
            'measurementId' => 'required|exists:inventory_measurements,id',
            'description' => 'required',
            'partNumber' => 'required',
            'isPhysicalQuantity' => 'required|boolean',
            'isChargedVat' => 'required|boolean',
            'isChargedOtherTax' => 'required|boolean',
            'unitPrice' => 'required|integer',
            'salesCommission' => 'required|integer',
            'leadDays' => 'required|integer',
            'reorderQuantity' => 'required|integer',
            'minimumQuantity' => 'required|integer',
            'maximumQuantity' => 'required|integer'
        ];
    }
}

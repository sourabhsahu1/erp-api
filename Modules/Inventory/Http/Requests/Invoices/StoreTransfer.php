<?php


namespace Modules\Inventory\Http\Requests\Invoices;


use App\Constants\AppConstant;
use Illuminate\Validation\Rule;
use Luezoid\Laravelcore\Requests\BaseRequest;

class StoreTransfer extends BaseRequest
{
    public function rules()
    {
        return [
            "storeId" => "required|exists:admin_companies,id",
            "receiveStoreId" => "required|exists:admin_companies,id",
            "date" => "required|date",
            "detail" => "required",
            "sourceDocReferenceNumber" => "required",
            "companyType" => [
                'required',
                Rule::in([
                    AppConstant::COMPANY_TYPE_STORE
                ])],
            "type" => [
                "required",
                Rule::in([
                    AppConstant::TYPE_OUT
                ])
            ],
            "items" => "required|array",
            "items.*.itemId" => "exists:inventory_items,id",
            "items.*.description" => "required",
            "items.*.accountCode" => "required|integer",
            "items.*.measurementId" => "exists:inventory_measurements,id",
            "items.*.quantity" => "required|integer"
        ];
    }

}

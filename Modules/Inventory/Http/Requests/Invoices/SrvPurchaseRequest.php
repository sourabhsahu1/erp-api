<?php


namespace Modules\Inventory\Http\Requests\Invoices;


use App\Constants\AppConstant;
use Illuminate\Validation\Rule;
use Luezoid\Laravelcore\Requests\BaseRequest;

class SrvPurchaseRequest extends BaseRequest
{
    public function rules()
    {
        return [
            "companyId" => "required|exists:admin_companies,id",
            "storeId" => "required|exists:admin_companies,id",
            "date" => "required|date",
            "referenceNumber" => "required",
            "poNumber" => "required",
            "sourceDocReferenceNumber" => "required",
            "companyType" => [
                'required',
                Rule::in([
                    AppConstant::COMPANY_TYPE_STORE,
                    AppConstant::COMPANY_TYPE_SUPPLIER,
                    AppConstant::COMPANY_TYPE_DEPARTMENT,
                    AppConstant::COMPANY_TYPE_CUSTOMER
                ])],
            "type" => [
                "required",
                Rule::in([
                    AppConstant::TYPE_OUT,
                    AppConstant::TYPE_IN
                ])
            ],
            "totalTax" => "required",
            "totalValue" => "required",
            "items" => "required|array",
            "items.*.itemId" => "exists:inventory_items,id",
            "items.*.description" => "required",
            "items.*.unitPrice" => "required|integer",
            "items.*.unitCost" => "required|integer",
            "items.*.measurementId" => "exists:inventory_measurements,id",
        ];
    }

}

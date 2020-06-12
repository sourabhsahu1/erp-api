<?php


namespace Modules\Inventory\Http\Requests\Invoices;


use App\Constants\AppConstant;
use Illuminate\Validation\Rule;
use Luezoid\Laravelcore\Requests\BaseRequest;

class SaleInward extends BaseRequest
{
    public function rules()
    {
        return [
            "companyId" => "required|exists:admin_companies,id",
            "storeId" => "required|exists:admin_companies,id",
            "date" => "required|date",
            "poNumber" => "required",
            "detail" => "required",
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
            "subTotal" => "required",
            "items" => "required|array",
            "items.*.itemId" => "exists:inventory_items,id",
            "items.*.description" => "required",
            "items.*.unitCost" => "required|integer",
            "items.*.measurementId" => "exists:inventory_measurements,id",
            "items.*.quantity" => "required|integer"
        ];
    }

}

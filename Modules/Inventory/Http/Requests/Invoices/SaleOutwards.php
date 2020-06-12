<?php


namespace Modules\Inventory\Http\Requests\Invoices;


use App\Constants\AppConstant;
use Illuminate\Validation\Rule;
use Luezoid\Laravelcore\Requests\BaseRequest;

class SaleOutwards extends BaseRequest
{
    public function rules()
    {
        $regex =  "/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/";
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
            "totalTax" => "required",
            "subTotal" => "required",
            "items" => "required|array",
            "items.*.itemId" => "exists:inventory_items,id",
            "items.*.description" => "required",
            "items.*.sellingPrice" => "required|integer",
            "items.*.measurementId" => "exists:inventory_measurements,id",
            "items.*.quantity" => "required|integer",
            "items.*.taxes.*.id" => "exists:admin_taxes,id",
            "items.*.taxes.*.tax" => ["required", "regex:".$regex]
        ];
    }

}

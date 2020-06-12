<?php


namespace Modules\Inventory\Http\Requests\Invoices;


use App\Constants\AppConstant;
use Illuminate\Validation\Rule;
use Luezoid\Laravelcore\Requests\BaseRequest;

class StoreInwards extends BaseRequest
{
    public function rules()
    {
        return [
            "companyId" => "required|exists:admin_companies,id",
            "storeId" => "required|exists:admin_companies,id",
            "date" => "required|date",
            "detail" => "required",
            "sourceDocReferenceNumber" => "required",
            "companyType" => [
                'required',
                Rule::in([
                    AppConstant::COMPANY_TYPE_DEPARTMENT
                ])],
            "type" => [
                "required",
                Rule::in([
                    AppConstant::TYPE_IN
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

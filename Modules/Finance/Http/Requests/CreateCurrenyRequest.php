<?php


namespace Modules\Finance\Http\Requests;


use Luezoid\Laravelcore\Requests\BaseRequest;
use Luezoid\Laravelcore\Services\RequestService;
use Modules\Hr\Models\Country;

class CreateCurrenyRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'codeCurrency' => 'required|string',
            'countryId' => [
                'required',
                RequestService::exists(Country::class,'id')
            ],
            'singularCurrencyName' => 'required|string',
            'pluralCurrencyName' => 'required|string',
            'currencySign' => 'required|string',
            'singularChangeName' => 'required|string',
            'pluralChangeName' => 'required|string',
            'changeSign' => 'required|string',
            'month_1' =>'required|numeric|between:0,9999999999.99',
            'month_2' => 'required|numeric|between:0,9999999999.99',
            'month_3' => 'required|numeric|between:0,9999999999.99',
            'month_4' => 'required|numeric|between:0,9999999999.99',
            'month_5' => 'required|numeric|between:0,9999999999.99',
            'month_6' => 'required|numeric|between:0,9999999999.99',
            'month_7' => 'required|numeric|between:0,9999999999.99',
            'month_8' => 'required|numeric|between:0,9999999999.99',
            'month_9' => 'required|numeric|between:0,9999999999.99',
            'month_10' => 'required|numeric|between:0,9999999999.99',
            'month_11' => 'required|numeric|between:0,9999999999.99',
            'month_12' => 'required|numeric|between:0,9999999999.99',
            'previousYearClosingRateLocal' => 'required|numeric|between:0,9999999999.99',
            'previousYearClosingRateInternational' => 'required|numeric|between:0,9999999999.99',
            "isActive"=> "required|boolean",
        ];
    }
}

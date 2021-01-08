<?php


namespace Modules\Treasury\Repositories;


use App\Constants\AppConstant;
use Illuminate\Support\Carbon;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Treasury\Models\Mandate;
use Modules\Treasury\Models\PaymentVoucher;

class MandateRepository extends EloquentBaseRepository
{


    public $model = Mandate::class;

    public function create($data)
    {
        $data['data']['status'] = 'NEW';
        $data['data']['prepared_by'] = $data['data']['user_id'];
        $data['data']['prepared_date'] = Carbon::now()->toDateString();
        $mandate = parent::create($data);
        $paymentVouchers = PaymentVoucher::whereIn('id', $data['data']['payment_vouchers'])
            ->update([
                'mandate_id' => $mandate->id
            ]);
        return $mandate;
    }

    public function update($data)
    {

        if (isset($data['data']['status'])) {
            if ($data['data']['status'] == AppConstant::ON_MANDATE_1ST_AUTHORISED) {
                $data['data']['first_authorised_by'] = $data['data']['user_id'];
                $data['data']['first_authorised_date'] = Carbon::now()->toDateString();
            }

            if ($data['data']['status'] == AppConstant::ON_MANDATE_2ND_AUTHORISED) {
                $data['data']['second_authorised_by'] = $data['data']['user_id'];
                $data['data']['second_authorised_date'] = Carbon::now()->toDateString();
            }
        }
        return parent::update($data);
    }
}

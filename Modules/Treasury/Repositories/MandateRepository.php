<?php


namespace Modules\Treasury\Repositories;


use App\Constants\AppConstant;
use Illuminate\Support\Carbon;
use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Finance\Models\JournalVoucher;
use Modules\Treasury\Models\Mandate;
use Modules\Treasury\Models\PaymentVoucher;
use Modules\Treasury\Models\ReceiptVoucher;

class MandateRepository extends EloquentBaseRepository
{


    public $model = Mandate::class;

    public function create($data)
    {

        $latestMandate = Mandate::latest()->orderby('id', 'desc')->first();

        if (is_null($latestMandate)) {
            $data['data']['batch_number'] = 1;
            $data['data']['treasury_number'] = 1;
        } else {
            $data['data']['batch_number'] = $latestMandate->batch_number + 1;
            $data['data']['treasury_number'] = $latestMandate->treasury_number + 1;
        }
        $data['data']['status'] = 'NEW';
        $data['data']['prepared_by'] = $data['data']['user_id'];
        $data['data']['prepared_date'] = Carbon::now()->toDateString();
        $mandate = parent::create($data);

        if (isset($data['data']['payment_vouchers'])) {
            $data['data']['payment_vouchers'] = json_decode($data['data']['payment_vouchers'], true);
            $paymentV = PaymentVoucher::whereIn('id', $data['data']['payment_vouchers'])
                ->whereIn('status', [
                    AppConstant::VOUCHER_STATUS_AUDITED
                ])->get();

            if ($paymentV->isEmpty()) {
                throw new AppException('payment vouchers are not audited');
            }
            $paymentVouchers = PaymentVoucher::whereIn('id', $data['data']['payment_vouchers'])
                ->update([
                    'mandate_id' => $mandate->id
                ]);
        }

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

                $paymentVouc = PaymentVoucher::where('mandate_id', $data['data']['id'])->update([
                    'status' => AppConstant::VOUCHER_STATUS_CLOSED
                ]);
            }

            if ($data['data']['status'] == AppConstant::ON_MANDATE_POSTED_TO_GL) {
                $paymentVouc = PaymentVoucher::where('mandate_id', $data['data']['id'])->update([
                    'status' => AppConstant::VOUCHER_STATUS_POSTED_TO_GL
                ]);

                //todo jv from pv

//                JournalVoucher::create([]);
            }
        }

        if (isset($data['data']['payment_vouchers'])) {

            $data['data']['payment_vouchers'] = json_decode($data['data']['payment_vouchers'], true);
            $paymentVouchers = PaymentVoucher::whereIn('id', $data['data']['payment_vouchers'])
                ->update([
                    'mandate_id' => $data['data']['id']
                ]);
        }

        return parent::update($data);
    }

}

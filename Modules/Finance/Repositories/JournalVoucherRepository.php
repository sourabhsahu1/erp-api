<?php


namespace Modules\Finance\Repositories;


use App\Constants\AppConstant;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Finance\Models\JournalVoucher;
use Modules\Finance\Models\JournalVoucherDetail;

class JournalVoucherRepository extends EloquentBaseRepository
{

    public $model = JournalVoucher::class;

    public function create($data)
    {

        $jvVoucherDetails = $data['data']['jv_detail'];

        $data['data']['prepared_user_id'] = $data['data']['user_id'];
        $data['data']['source_app'] = "PLINYEGL";
        $data['data']['status'] = "NEW";
        unset($data['data']['jv_detail']);

        DB::beginTransaction();
        try {
            $jv = parent::create($data);
            foreach ($jvVoucherDetails as $key => $detail) {
                $jvVoucherDetails[$key]['journal_voucher_id'] = $jv->id;
            }

            $newData = null;
            foreach ($jvVoucherDetails as $key => $jvVoucherDetail) {
                $newData[] = array_intersect_key($jvVoucherDetail,
                    array_flip(
                        [
                            'journal_voucher_id',
                            'currency',
                            'x_rate_local',
                            'bank_x_rate_to_usd',
                            'account_name',
                            'line_reference',
                            'line_value',
                            'admin_segment_id',
                            'fund_segment_id',
                            'economic_segment_id',
                            'programme_segment_id',
                            'functional_segment_id',
                            'geo_code_segment_id',
                            'line_value_type',
                            'lv_line_value'
                        ]));
            }
            JournalVoucherDetail::insert($newData);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return JournalVoucher::with('journal_voucher_details')->find($jv->id);
    }


//validations
    public function update($data)
    {
        return parent::update($data);
    }

//validations
    public function delete($data)
    {
        return parent::delete($data);
    }

    public function getAll($params = [], $query = null)
    {
        return parent::getAll($params, $query);
    }


    public function updateStatus($data)
    {
        $jv = JournalVoucher::whereIn('id', $data['data']['jv_reference_numbers']);

        if (isset($data['data']['status'])) {
            if ($data['data']['status'] == 'CHECKED') {
                $jv->update([
                    'status' => AppConstant::JV_STATUS_CHECKED,
                    'checked_user_id' => $data['data']['user_id'],
                    'checked_value_date' => Carbon::now()->toDateTimeString(),
                    'checked_transaction_date' => Carbon::now()->toDateTimeString(),
                ]);
            } elseif ($data['data']['status'] == 'POSTED') {
                $jv->update([
                    'status' => AppConstant::JV_STATUS_POSTED,
                    'posted_user_id' => $data['data']['user_id'],
                    'posted_value_date' => Carbon::now()->toDateTimeString(),
                    'posted_transaction_date' => Carbon::now()->toDateTimeString()
                ]);
            } else {
                throw new AppException('Invalid status');
            }
        }

        return ['success' => strtolower($data['data']['status']) . ' successfully'];
    }

}

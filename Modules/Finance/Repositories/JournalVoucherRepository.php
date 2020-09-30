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

            $lv['CREDIT'] = 0;
            $lv['DEBIT'] = 0;
            foreach ($newData as $item) {
               $lv[$item['line_value_type']] += $item['lv_line_value'];
            }

            if ($lv['CREDIT'] != $lv['DEBIT']) {
                throw new  AppException('DEBIT and CREDIT values are not equal');
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


    //todo filter to added in this function
    public function getAll($params = [], $query = null)
    {
        if(isset($params['inputs']['status']))
        {
            if($params['inputs']['status'] == AppConstant::JV_STATUS_NEW)
            {
                $query=JournalVoucher::where('status',$params['inputs']['status']);
            }
            else if($params['inputs']['status'] == AppConstant::JV_STATUS_POSTED)
            {
                $query=JournalVoucher::where('status',$params['inputs']['status']);
            }
            else if($params['inputs']['status'] == AppConstant::JV_STATUS_CHECKED)
            {
                $query=JournalVoucher::where('status',$params['inputs']['status']);
            }

        }

        if(isset($params['inputs']['source']))
        {
            $query=JournalVoucher::where('source_app',$params['inputs']['source']);
        }

        if(isset($params['inputs']['from']) && isset($params['inputs']['to']))
        {
            $params['inputs']['from'] = $params['inputs']['from'].' 00:00:00';
            $params['inputs']['to'] = $params['inputs']['to'].' 23:59:59';

            $query = JournalVoucher::where('created_at','>=',$params['inputs']['from'])
                ->where('created_at','<=',$params['inputs']['to']);
        }
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

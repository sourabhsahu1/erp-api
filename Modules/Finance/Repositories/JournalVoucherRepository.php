<?php


namespace Modules\Finance\Repositories;


use App\Constants\AppConstant;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Admin\Models\AdminSegment;
use Modules\Finance\Models\JournalVoucher;
use Modules\Finance\Models\JournalVoucherDetail;
use Modules\Finance\Models\JvTrailBalanceReport;

class JournalVoucherRepository extends EloquentBaseRepository
{

    public $model = JournalVoucher::class;

    public function create($data)
    {

        $jvVoucherDetails = $data['data']['jv_detail'];

        $data['data']['prepared_user_id'] = $data['data']['user_id'];
        $data['data']['source_app'] = "PLINYEGL";
        $data['data']['status'] = "NEW";


        DB::beginTransaction();
        try {
            $jv = parent::create($data);
            if (count($data['data']['jv_detail']) <= 0) {
                DB::commit();
                return $jv;
            }
            unset($data['data']['jv_detail']);
            foreach ($jvVoucherDetails as $key => $detail) {
                $jvVoucherDetails[$key]['journal_voucher_id'] = $jv->id;
                $jvVoucherDetails[$key]['created_at'] = Carbon::now()->toDateTimeString();
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
                            'lv_line_value',
                            'created_at'
                        ]));
            }

//            $lv['CREDIT'] = 0;
//            $lv['DEBIT'] = 0;
//            foreach ($newData as $item) {
//                $lv[$item['line_value_type']] += $item['lv_line_value'];
//            }

//            if ($lv['CREDIT'] != $lv['DEBIT']) {
//                throw new  AppException('DEBIT and CREDIT values are not equal');
//            }

            JournalVoucherDetail::insert($newData);


            $jds = JournalVoucherDetail::where('journal_voucher_id', $jv->id)->get();


            foreach ($jds as $jd) {
                $jd = $jd->toArray();
                $this->insertInTrailReport($jd);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return JournalVoucher::with('journal_voucher_details')->find($jv->id);
    }


    function insertInTrailReport($jd)
    {

        $existingJv = JvTrailBalanceReport::where('economic_segment_id', $jd['economic_segment_id'])->first();

        $parent = AdminSegment::where('id', $jd['economic_segment_id'])->first();
        if ($parent->parent_id == null) {
            return;
        }

        if (is_null($existingJv)) {
            $data = [
                'economic_segment_id' => $jd['economic_segment_id'],
                'parent_id' => $parent->parent_id ?? null,
                'credit' => 0,
                'debit' => 0,
                'balance' => 0
            ];

            if ($jd['line_value_type'] == 'DEBIT') {
                $data['debit'] = $jd['lv_line_value'];
                $data['balance'] = abs($data['debit'] - $data['credit']);
            } elseif ($jd['line_value_type'] == 'CREDIT') {
                $data['credit'] = $jd['lv_line_value'];
                $data['balance'] = abs($data['credit'] - $data['debit']);
            }

            $jv = JvTrailBalanceReport::create($data);
Log::info($jv);
            if ($parent->parent_id != null) {
                $this->insertInTrailReport([
                    'economic_segment_id' => $parent->parent_id,
                    'lv_line_value' => $jd['lv_line_value'],
                    'line_value_type' => $jd['line_value_type']
                ]);
            }

        } else {
            $this->updateTrailReport($existingJv, $jd);
        }
    }


    function updateTrailReport($existingJv, $jd)
    {
        if (is_null($existingJv)) {
            return;
        }
        $data = [
            'debit' => $existingJv->debit,
            'credit' => $existingJv->credit
        ];
        if ($jd['line_value_type'] == 'DEBIT') {
            $data['debit'] += $jd['lv_line_value'];
        }
        if ($jd['line_value_type'] == 'CREDIT') {
            $data['credit'] += $jd['lv_line_value'];
        }
        $data['balance'] = abs($data['debit'] - $data['credit']);
        $existingJv->update($data);
        $this->updateTrailReport(JvTrailBalanceReport::where('economic_segment_id', $existingJv['parent_id'])->first(), $jd);

    }

    public function update($data)
    {

        /** @var JournalVoucher $jv */
        $jv = parent::find($data['id']);

        if ($jv && $jv->status != AppConstant::JV_STATUS_NEW) {
            throw new AppException('Cannot update');
        }
        $data['data']['prepared_user_id'] = $data['data']['user_id'];
        return parent::update($data);
    }

    public function delete($data)
    {
        $jv = parent::find($data['id']);

        if ($jv && $jv->status != AppConstant::JV_STATUS_NEW) {
            throw new AppException('Cannot Delete');
        }
        return parent::delete($data);
    }


    public function getAll($params = [], $query = null)
    {
        if (isset($params['inputs']['status'])) {
            if ($params['inputs']['status'] == AppConstant::JV_STATUS_NEW) {
                $query = JournalVoucher::where('status', $params['inputs']['status']);
            } else if ($params['inputs']['status'] == AppConstant::JV_STATUS_POSTED) {
                $query = JournalVoucher::where('status', $params['inputs']['status']);
            } else if ($params['inputs']['status'] == AppConstant::JV_STATUS_CHECKED) {
                $query = JournalVoucher::where('status', $params['inputs']['status']);
            }

        }

        if (isset($params['inputs']['source'])) {
            $query = JournalVoucher::where('source_app', $params['inputs']['source']);
        }

        if (isset($params['inputs']['from']) && isset($params['inputs']['to'])) {
            $params['inputs']['from'] = $params['inputs']['from'] . ' 00:00:00';
            $params['inputs']['to'] = $params['inputs']['to'] . ' 23:59:59';

            $query = JournalVoucher::where('created_at', '>=', $params['inputs']['from'])
                ->where('created_at', '<=', $params['inputs']['to']);
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
            } elseif ($data['data']['status'] == 'RENEW') {
                $jv->update([
                    'status' => AppConstant::JV_STATUS_NEW
                ]);
            } else {
                throw new AppException('Invalid status');
            }
        }

        return ['success' => strtolower($data['data']['status']) . ' successfully'];
    }

}

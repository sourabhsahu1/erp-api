<?php


namespace Modules\Finance\Repositories;


use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Finance\Models\JournalVoucherDetail;


class JournalVoucherDetailRepository extends EloquentBaseRepository
{
    public $model = JournalVoucherDetail::class;


    public function create($data)
    {
        $data['data']['journal_voucher_id'] = $data['data']['id'];
        $jvDetail = JournalVoucherDetail::where('journal_voucher_id', $data['data']['journal_voucher_id'])
            ->where('economic_segment_id', $data['data']['economic_segment_id'])->first();

        if ($jvDetail) {
            throw new AppException('Detail Line with this economic segment already exists');
        }
        return parent::create($data);
    }

    public function update($data)
    {
        $data['data']['journal_voucher_id'] = $data['data']['id'];
        $jvDetail = JournalVoucherDetail::where('journal_voucher_id', $data['data']['id'])
            ->where('id', $data['data']['detail_id'])
            ->first();

        $jvDetailCheck = JournalVoucherDetail::where('journal_voucher_id', $data['data']['journal_voucher_id'])
            ->where('economic_segment_id', $data['data']['economic_segment_id'])
            ->first();

        if ($jvDetailCheck) {
            throw new AppException('Detail Line with this economic segment already exists');
        }

        if ($jvDetail) {
            return parent::update($data);
        } else {
            throw new AppException('Not exist');
        }
    }

    public function delete($data)
    {

        $jvDetail = JournalVoucherDetail::where('journal_voucher_id', $data['data']['id'])->where('id', $data['data']['detail_id'])->first();
        if ($jvDetail) {
            $jvDetail->delete();
            return $jvDetail;
        } else {
            throw new AppException('Not exist');
        }
    }

    public function show($data, $params = null)
    {
        $jvDetail = JournalVoucherDetail::with([
            'programme_segment',
            'admin_segment',
            'fund_segment',
            'economic_segment',
            'functional_segment',
            'geo_code_segment'
        ])->where('journal_voucher_id', $data['data']['id'])->where('id', $data['data']['detail_id'])->first();
        if ($jvDetail) {
            return $jvDetail;
        } else {
            throw  new AppException('not exist');
        }
    }
}

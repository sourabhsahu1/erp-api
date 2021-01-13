<?php


namespace Modules\Treasury\Repositories;


use App\Constants\AppConstant;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Treasury\Models\PaymentVoucher;
use Modules\Treasury\Models\RetireLiability;
use Modules\Treasury\Models\RetireVoucher;

class RetireVoucherRepository extends EloquentBaseRepository
{
    public $model = RetireVoucher::class;

    public function getAll($params = [], $query = null)
    {
        $this->model = PaymentVoucher::class;
        $query = PaymentVoucher::with([
            'program_segment',
            'economic_segment',
            'functional_segment',
            'geo_code_segment',
            'admin_segment',
            'fund_segment',
            'aie',
            'currency',
            'voucher_source_unit',
            'total_amount',
            'total_tax',
            'payee_vouchers.admin_company.company_bank.bank_branch.hr_bank',
            'payee_vouchers.employee.employee_bank.branches.hr_bank',
            'schedule_economic.economic_segment',
            'paying_officer',
            'checking_officer',
            'financial_controller',
            'retire_voucher.retire_liabilities.economic_segment'
        ])->whereIn('type', [
            AppConstant::VOUCHER_TYPE_SPECIAL_VOUCHER,
            AppConstant::VOUCHER_TYPE_STANDING_VOUCHER,
            AppConstant::VOUCHER_TYPE_NON_PERSONAL_VOUCHER
        ])->where('status', AppConstant::VOUCHER_STATUS_CLOSED);
        return parent::getAll($params, $query);
    }

    public function create($data)
    {

        $retireV = RetireVoucher::create([
            'payment_voucher_id' => $data['data']['payment_voucher_id'],
            'status' => AppConstant::RETIRE_VOUCHER_NEW
        ]);

        foreach ($data['data']['liabilities'] as $key => $liability) {
            $d['retire_voucher_id'] = $retireV->id;
            $d['liability_value_date'] = $liability['liability_value_date'];
            $d['amount'] = $liability['amount'];
            $d['economic_segment_id'] = $liability['economic_segment_id'];
            $d['details'] = $liability['details'];
            $d['created_at'] = Carbon::now()->toDateTimeString();
            $d['updated_at'] = Carbon::now()->toDateTimeString();

            unset($data);
            $liabilities[] = $d;
        }

        if (count($liabilities) > 0) {
            RetireLiability::insert($liabilities);
        }

        return RetireVoucher::with('retire_liabilities')->find($retireV->id);
    }


    public function update($data)
    {

        $data['data']['payment_voucher_ids'] = json_decode($data['data']['payment_voucher_ids'], true);
        $retireV = RetireVoucher::whereIn('payment_voucher_id', $data['data']['payment_voucher_ids']);

        if ($retireV->get()->isEmpty()) {
            throw new AppException('Cannot find Retire Voucher');
        } else {
            $retireV->update(['status' => $data['data']['status']]);
        }
    }

    public function statusRetireVoucher()
    {
        $status = DB::table('treasury_status_retire_voucher')->get();
        return [
            'status' => $status
        ];
    }
}

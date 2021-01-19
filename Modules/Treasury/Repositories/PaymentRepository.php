<?php


namespace Modules\Treasury\Repositories;


use App\Constants\AppConstant;
use Illuminate\Support\Facades\DB;
use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Admin\Models\CompanySetting;
use Modules\Treasury\Models\PayeeVoucher;
use Modules\Treasury\Models\PaymentApproval;
use Modules\Treasury\Models\PaymentVoucher;
use Modules\Treasury\Models\ScheduleEconomic;
use Modules\Treasury\Models\VoucherSourceUnit;

class PaymentRepository extends EloquentBaseRepository
{
    public $model = PaymentVoucher::class;

    public function create($data)
    {

        $paymentV = PaymentVoucher::latest()->orderby('id', 'desc')->first();

        if (is_null($paymentV)) {
            $data['data']['deptal_id'] = 1;
        } else {
            $data['data']['deptal_id'] = $paymentV->deptal_id + 1;
        }
        $data['data']['status'] = 'NEW';


        /** @var CompanySetting $companySetting */
        $companySetting = CompanySetting::find(1);
        if ($companySetting->is_payment_approval == true) {
            if (!isset($data['data']['payment_approve_id'])) {
                throw new AppException('Payment Approve Id is required');
            }
//            $paymentVoucher =  parent::create($data);
//            $paymentApproval = PaymentApproval::where('id',$data['data']['payment_approve_id'])->update();
        }
        return parent::create($data);
    }

    public function update($data)
    {

        return parent::update($data);
    }

    public function getAll($params = [], $query = null)
    {
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
            'financial_controller'
        ]);

        if (isset($params['inputs']['voucher_source_unit_id'])) {
            $query->where('voucher_source_unit_id', $params['inputs']['voucher_source_unit_id']);
        }

        if (isset($params['inputs']['status'])) {
            $query->where('status', $params['inputs']['status']);
        }
        /* $query->with(['total_tax' => function ($tax) {
             $tax->selectRaw('SUM(total_tax)');
         }]);*/
        return parent::getAll($params, $query);
    }


    public function updateStatus($data)
    {

        $pv = PaymentVoucher::whereIn('id', $data['data']['payment_voucher_ids']);

        foreach ($data['data']['payment_voucher_ids'] as $payment_voucher_id) {

            $pv = PaymentVoucher::where('id', $payment_voucher_id)->first();
            $payeeVoucherIds = PayeeVoucher::where('payment_voucher_id', $pv->id)->pluck('id')->all();

            if (is_null($payeeVoucherIds)) {
                throw new AppException('Payee not added');
            }

            $scheduleVoucher = ScheduleEconomic::whereIn('payee_voucher_id', $payeeVoucherIds)->first();

            if (is_null($scheduleVoucher)) {
                throw new AppException('Schedule Economic not added');
            }
        }
        $pv->update([
            'status' => $data['data']['status']
        ]);
        return [
            'data' => 'Status Updated Successfully'
        ];
    }

    public function typePaymentVoucher($params)
    {
        /** @var VoucherSourceUnit $vsu */
        $vsu = VoucherSourceUnit::where('id', $params['inputs']['id'])->first();

        if (is_null($vsu)) {
            throw new AppException('voucher source unit not exist');
        } else {
            if ($vsu->is_personal_advance_unit == true) {
                return [
                    'type' => [
                        [
                            'name' => 'PERSONAL ADVANCES VOUCHER',
                            'value' => AppConstant::VOUCHER_TYPE_PERSONAL_ADVANCES_VOUCHER
                        ],
                        [
                            'name' => 'NON PERSONAL VOUCHER',
                            'value' => AppConstant::VOUCHER_TYPE_NON_PERSONAL_VOUCHER
                        ],
                        [
                            'name' => 'SPECIAL IMPREST VOUCHER',
                            'value' => AppConstant::VOUCHER_TYPE_SPECIAL_VOUCHER
                        ],
                        [
                            'name' => 'STANDING IMPREST VOUCHER',
                            'value' => AppConstant::VOUCHER_TYPE_STANDING_VOUCHER
                        ]
                    ]
                ];
            } elseif ($vsu->is_personal_advance_unit == false) {

                return [
                    'type' => [

                        [
                            'name' => 'TRANSFER CASHBOOK VOUCHER',
                            'value' => AppConstant::VOUCHER_TYPE_TRANSFER_CASHBOOK_VOUCHER
                        ],
                        [
                            'name' => 'DEPOSIT VOUCHER',
                            'value' => AppConstant::VOUCHER_TYPE_DEPOSIT_VOUCHER
                        ],
                        [
                            'name' => 'REMITTANCE VOUCHER',
                            'value' => AppConstant::VOUCHER_TYPE_REMITTANCE_VOUCHER
                        ],
                        [
                            'name' => 'EXPENDITURE VOUCHER',
                            'value' => AppConstant::VOUCHER_TYPE_EXPENDITURE_VOUCHER
                        ], [
                            'name' => 'CREDIT VOUCHER',
                            'value' => AppConstant::VOUCHER_TYPE_EXPENDITURE_CREDIT_VOUCHER
                        ]
                    ]
                ];
            }
        }

    }

    public function statusPaymentVoucher()
    {
        $status = DB::table('treasury_status_payment_voucher')->get();
        return [
            'status' => $status
        ];
    }
}

<?php


namespace Modules\Finance\Http\Requests\JournalVoucherDetail;


use App\Constants\AppConstant;
use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Requests\BaseRequest;
use Modules\Finance\Models\JournalVoucher;

class Delete extends BaseRequest
{
    public function rules()
    {
        /** @var JournalVoucher $jv */
        $jv = JournalVoucher::find($this->route('id'));
        if ($jv->status != AppConstant::JV_STATUS_NEW) {
            throw new AppException('Cannot Delete Status is not NEW');
        }

    }

}

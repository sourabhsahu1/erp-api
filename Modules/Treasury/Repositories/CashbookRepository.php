<?php


namespace Modules\Treasury\Repositories;


use Illuminate\Support\Facades\DB;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Treasury\Models\Cashbook;
use Modules\Treasury\Models\CashbookMonthlyBalance;

class CashbookRepository extends EloquentBaseRepository
{
    public $model = Cashbook::class;

    public function create($data)
    {
        $cashbookMonthly = $data['data']['cashbook_monthly'];
        unset($data['data']['cashbook_monthly']);

        DB::beginTransaction();
        try {
            $cashbook = parent::create($data);
            foreach ($cashbookMonthly as $key => $item) {
                $cashbookMonthly[$key]['cashbook_id'] = $cashbook->id;
            }
            CashbookMonthlyBalance::insert($cashbookMonthly);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return Cashbook::with('cashbook_monthly_balances')->find($cashbook->id);
    }
}

<?php


namespace Modules\Treasury\Repositories;


use Illuminate\Support\Facades\DB;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Treasury\Models\Cashbook;
use Modules\Treasury\Models\CashbookMonthlyBalance;
use Modules\Treasury\Models\CashbookType;

class CashbookRepository extends EloquentBaseRepository
{
    public $model = Cashbook::class;

    public function create($data)
    {
        if (isset($data['data']['cashbook_monthly'])) {
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
        } else {
            $cashbook = parent::create($data);
        }


        return Cashbook::with('cashbook_monthly_balances')->find($cashbook->id);
    }


    public function update($data)
    {

        $cashbookMonthly = $data['data']['cashbook_monthly'];
        unset($data['data']['cashbook_monthly']);

        DB::beginTransaction();
        try {
            $cashbook = parent::update($data);

            CashbookMonthlyBalance::where('cashbook_id', $data['id'])->delete();

            foreach ($cashbookMonthly as $key => &$item) {
                unset($item['id']);
                $cashbookMonthly[$key]['cashbook_id'] = $cashbook->id;
            }

            CashbookMonthlyBalance::insert($cashbookMonthly);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return Cashbook::with('cashbook_monthly_balances')->find($data['id']);
    }


    public function getCashbookTypes($params)
    {
        $this->model = CashbookType::class;
        return parent::getAll($params);
    }


}

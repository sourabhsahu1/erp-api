<?php


namespace Modules\Finance\Repositories;


use function Aws\clear_compiled_json;
use Illuminate\Support\Facades\DB;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Finance\Models\Budget;
use Modules\Finance\Models\BudgetBreakup;

class BudgetRepository extends EloquentBaseRepository
{
    public $model = Budget::class;


    public function create($data)
    {

        $budgets = $data['data']['budget_breakups'];
        unset($data['data']['budget_breakups']);

        DB::beginTransaction();
        try {
            $budget = parent::create($data);
            foreach ($budgets as $key => $item) {
                $budgets[$key]['budget_id'] = $budget->id;
            }
            BudgetBreakup::insert($budgets);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return Budget::with('budget_breakups')->find($budget->id);
    }


    public function getAll($params = [], $query = null)
    {

        $query = Budget::whereNull('economic_segment_id');
        $budgets = parent::getAll($params, $query);

        foreach ($budgets['items'] as $k => &$budget) {

            $budget = $budget->toArray();

            $sumB = 0;
            $sumS = 0;

            for ($i = 1; $i <= 12; $i++) {
                $budget['month' . $i . '_main_budget'] = null;
                $budget['month' . $i . '_supplementary_budget'] = null;
            }

            if (isset($budget['budget_breakups'])) {
                foreach ($budget['budget_breakups'] as $k1 => $item) {
                    $budget['month' . $item['month'] . '_main_budget'] = $item['main_budget'];
                    $budget['month' . $item['month'] . '_supplementary_budget'] = $item['supplementary_budget'];
                    $sumB += $item['main_budget'];
                    $sumS += $item['supplementary_budget'];
                }
            }

            $budget['total_budget'] = $sumB;
            $budget['total_supplementary_budget'] = $sumS;
        }
        return $budgets;
    }


    public function getEconomicBudget($params) {

        $query = Budget::whereNull('program_segment_id');
        $budgets = parent::getAll($params, $query);

        foreach ($budgets['items'] as $k => &$budget) {

            $budget = $budget->toArray();

            $sumB = 0;
            $sumS = 0;

            for ($i = 1; $i <= 12; $i++) {
                $budget['month' . $i . '_main_budget'] = null;
                $budget['month' . $i . '_supplementary_budget'] = null;
            }

            if (isset($budget['budget_breakups'])) {
                foreach ($budget['budget_breakups'] as $k1 => $item) {
                    $budget['month' . $item['month'] . '_main_budget'] = $item['main_budget'];
                    $budget['month' . $item['month'] . '_supplementary_budget'] = $item['supplementary_budget'];
                    $sumB += $item['main_budget'];
                    $sumS += $item['supplementary_budget'];
                }
            }

            $budget['total_budget'] = $sumB;
            $budget['total_supplementary_budget'] = $sumS;
        }
        return $budgets;
    }


    public function update($data)
    {

        $budgets = $data['data']['budget_breakups'];
        unset($data['data']['budget_breakups']);

        DB::beginTransaction();
        try {
            $budget = parent::update($data);

            BudgetBreakup::where('budget_id', $data['id'])->delete();

            foreach ($budgets as $key => &$item) {
                unset($item['id']);
                $budgets[$key]['budget_id'] = $budget->id;
            }

            BudgetBreakup::insert($budgets);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return Budget::with('budget_breakups')->find($data['id']);
    }


}

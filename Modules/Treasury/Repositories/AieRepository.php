<?php


namespace Modules\Treasury\Repositories;


use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Treasury\Models\Aie;
use Modules\Treasury\Models\AieEconomicBalance;

class AieRepository extends EloquentBaseRepository
{

    public $model = Aie::class;


    public function getAll($params = [], $query = null)
    {
        $query = Aie::query();
        $query->where('fund_segment_id', $params['inputs']['fund_segment_id'])
            ->where('admin_segment_id', $params['inputs']['admin_segment_id']);
        return parent::getAll($params, $query);
    }

    public function create($data)
    {

        $query = Aie::where('fund_segment_id', $data['data']['fund_segment_id'])
            ->where('admin_segment_id', $data['data']['admin_segment_id'])
            ->first();
        if ($query) {
            throw new AppException('Required Aie is already exists');
        }

        DB::beginTransaction();
        try {
            $aie = parent::create($data);

            $balance = [];
            if (isset($data['data']['aie_economic_balances'])) {
                foreach ($data['data']['aie_economic_balances'] as $aie_economic_balance) {
                    $temp = [
                        'aie_id' => $aie->id,
                        'economic_segment_id' => $aie_economic_balance['economic_segment_id'],
                        'amount' => $aie_economic_balance['amount'],
                        'created_at' => Carbon::now()->toDateTimeString(),
                        'updated_at' => Carbon::now()->toDateTimeString()
                    ];

                    $balance[] = $temp;
                }
                AieEconomicBalance::insert($balance);
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

        return Aie::with('aie_economic_balances', 'fund_segment')->where('id', $aie->id)->first();
    }


    public function update($data)
    {

        //todo validation
        $aieBalance = $data['data']['aie_economic_balances'];
        unset($data['data']['aie_economic_balances']);

        DB::beginTransaction();
        try {
            $aie = parent::update($data);
            AieEconomicBalance::where('aie_id', $data['data']['aie'])->delete();

            foreach ($aieBalance as $key => &$item) {
                unset($item['id']);
                $aieBalance[$key]['aie_id'] = $aie->id;
                $aieBalance[$key]['created_at'] = Carbon::now()->toDateTimeString();
                $aieBalance[$key]['updated_at'] = Carbon::now()->toDateTimeString();
            }
            AieEconomicBalance::insert($aieBalance);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

        return Aie::with('aie_economic_balances', 'fund_segment')->where('id', $aie->id)->first();
    }
}

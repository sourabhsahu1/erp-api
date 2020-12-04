<?php


namespace Modules\Finance\Repositories;


use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\Bank;
use Modules\Hr\Models\BankBranch;

class BankBranchRepository extends EloquentBaseRepository
{

    public $model = BankBranch::class;

    public function create($data)
    {
        $bank_id = $data['data']['bank_id'];

        $checker = Bank::select('id')->where('id',$bank_id)->exists();

        if($checker)
        {
            return parent::create($data);
        }
        else
        {
            throw new AppException("Bank id not found");
        }
    }

    public function delete($data)
    {

        $branchBranch = BankBranch::where('bank_id', $data['data']['bank_id'])->where('id', $data['data']['branch'])->first();

        if ($branchBranch) {
            $branchBranch->delete();
            return $branchBranch;
        }else {
            throw new AppException('already deleted or not exist');
        }

    }
}

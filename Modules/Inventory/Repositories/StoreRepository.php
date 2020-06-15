<?php


namespace Modules\Inventory\Repositories;


use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Inventory\Models\InvoiceDetail;
use Modules\Inventory\Models\Store;

class StoreRepository extends EloquentBaseRepository
{

    public $model = Store::class;

    public function delete($data)
    {
        $data = InvoiceDetail::where('store_id', $data['id'])->first();
        if (is_null($data)) {
            return parent::delete($data);
        }else {
            throw new AppException('Already in use');
        }
    }
}

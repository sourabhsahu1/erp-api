<?php


namespace Modules\Inventory\Repositories;


use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Inventory\Models\InvoiceItem;
use Modules\Inventory\Models\Measurement;

class MeasurementRepository extends EloquentBaseRepository
{
    public $model = Measurement::class;

    public function delete($data)
    {
        $invoiceItem = InvoiceItem::where('measurement_id', $data['id'])->first();

        if (is_null($invoiceItem)) {
            return parent::delete($data);
        }else {
            throw new AppException('Already in use');
        }
    }
}

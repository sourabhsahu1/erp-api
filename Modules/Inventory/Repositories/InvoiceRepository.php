<?php


namespace Modules\Inventory\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Inventory\Models\InvoiceDetail;

class InvoiceRepository extends EloquentBaseRepository
{
    public $model = InvoiceDetail::class;

    public function create($data)
    {
//        InvoiceDetail::create([]);

        return parent::create($data);
    }
}

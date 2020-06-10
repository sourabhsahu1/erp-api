<?php


namespace Modules\Inventory\Repositories;


use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Inventory\Models\InvoiceDetail;
use Modules\Inventory\Models\InvoiceItem;

class InvoiceRepository extends EloquentBaseRepository
{
    public $model = InvoiceDetail::class;

    public function srvPurchase($data)
    {

        $invoiceDetail = parent::create($data);

        $items = null;
        foreach ($data['data']['items'] as $item) {
            $items = [

            ];
        }
        $items = InvoiceItem::create([
            'store_id' => $data['data']['storeId'],
            'item_id' => $data['data']['itemId'],
            'invoice_id' => $data['data'][''],
            'measurement_id' => $data['data'][''],
            'description' => $data['data'][''],
            'unit_cost' => $data['data'][''],
            'quantity' => $data['data'][''],
        ]);

    }
}

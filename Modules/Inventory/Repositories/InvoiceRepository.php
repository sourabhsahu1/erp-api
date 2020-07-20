<?php


namespace Modules\Inventory\Repositories;


use App\Constants\AppConstant;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Inventory\Models\InvoiceDetail;
use Modules\Inventory\Models\InvoiceItem;
use Modules\Inventory\Models\InvoiceTax;
use Modules\Inventory\Models\ItemsAvgCost;
use Modules\Inventory\Models\ItemsFifoCost;
use Modules\Inventory\Models\ItemsLifoCost;

class InvoiceRepository extends EloquentBaseRepository
{
    public $model = InvoiceDetail::class;

    public function srvPurchase($data)
    {
        DB::beginTransaction();
        try {
            $invoiceDetail = parent::create($data);
            $items = null;
            $taxes = null;
            foreach ($data['data']['items'] as $item) {
                /** @var InvoiceItem $availableQuantity */
                $availableQuantity = InvoiceItem::where('item_id', $item['item_id'])->orderBy('id', 'desc')->first();

                $invoiceItem = InvoiceItem::create([
                    'store_id' => $data['data']['store_id'],
                    'item_id' => $item['item_id'],
                    'invoice_id' => $invoiceDetail->id,
                    'measurement_id' => $item['measurement_id'],
                    'description' => $item['description'],
                    'available_balance' => $item['quantity'] + (!is_null($availableQuantity) ? $availableQuantity->available_balance : 0),
                    'unit_cost' => $item['unit_cost'],
                    'quantity' => $item['quantity'],
                    'created_at' => Carbon::now()->toDateString(),
                    'updated_at' => Carbon::now()->toDateString()
                ]);

//                ItemsLifoCost::create([
//                    'item_id' => $item['item_id'],
//                    'invoice_item_id' => $invoiceItem->id,
//                    'invoice_id' => $invoiceDetail->id,
//                    'quantity' => $item['quantity'],
//                    'price' => $item['unit_cost'],
//                    'available_quantity' => $item['quantity'],
//                    'type' => AppConstant::TYPE_IN,
//
//                ]);
//                ItemsFifoCost::create([
//                    'item_id' => $item['item_id'],
//                    'invoice_item_id' => $invoiceItem->id,
//                    'invoice_id' => $invoiceDetail->id,
//                    'quantity' => $item['quantity'],
//                    'price' => $item['unit_cost'],
//                    'available_quantity' => $item['quantity'],
//                    'type' => AppConstant::TYPE_IN,
//
//                ]);
//
//                ItemsAvgCost::create([
//                    'item_id' => $item['item_id'],
//                    'invoice_item_id' => $invoiceItem->id,
//                    'invoice_id' => $invoiceDetail->id,
//                    'quantity' => $item['quantity'],
//                    'price' => $item['unit_cost'],
//                    'available_quantity' => $item['quantity'],
//                    'type' => AppConstant::TYPE_IN,
//
//                ]);

                foreach ($item['taxes'] as $tax) {
                   $itemTaxes =  InvoiceTax::create([
                        'invoice_id' => $invoiceDetail->id,
                        'item_id' => $item['item_id'],
                        'tax' => $tax['tax'],
                        'tax_id' => $tax['id']
                    ]);

                }
            }

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();

        return $invoiceDetail;
    }

    public function srvReturn($data)
    {

        DB::beginTransaction();

        try {
            $invoiceDetail = parent::create($data);
            $items = null;
            foreach ($data['data']['items'] as $item) {
                /** @var InvoiceItem $availableQuantity */
                $availableQuantity = InvoiceItem::where('item_id', $item['item_id'])->orderBy('id', 'desc')->first();

                $invoiceItem = InvoiceItem::create([
                    'store_id' => $data['data']['store_id'],
                    'item_id' => $item['item_id'],
                    'invoice_id' => $invoiceDetail->id,
                    'measurement_id' => $item['measurement_id'],
                    'description' => $item['description'],
                    'available_balance' => $item['quantity'] + (!is_null($availableQuantity) ? $availableQuantity->available_balance : 0),
                    'unit_cost' => $item['unit_cost'],
                    'quantity' => $item['quantity'],
                    'created_at' => Carbon::now()->toDateString(),
                    'updated_at' => Carbon::now()->toDateString()
                ]);

                $cost = [
                    'item_id' => $item['item_id'],
                    'invoice_id' => $invoiceDetail->id,
                    'quantity' => $item['quantity'],
                    'invoice_item_id' => $invoiceItem->id,
                    'selling_price' => $item['unit_cost'],
                    'type' => AppConstant::TYPE_OUT
                ];

//                $fifo = $this->fifo($cost);
//                $lifo = $this->lifo($cost);
//                $avg = $this->avg($cost);

            }


        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();

        return $invoiceDetail;
    }


    public function fifo($item)
    {

        //all items that were out
//        foreach ($items as $item) {
            //items that are available
            $fifoItems = ItemsFifoCost::where('item_id', $item['item_id'])
                ->where('quantity', '>', 0)
                ->where('is_active', true)
                ->where('type', AppConstant::TYPE_IN)
                ->get();

            //items list for fifo calculation
            foreach ($fifoItems as $fifoItem) {
                $quantity = $item['quantity'];
                $item['quantity'] = $fifoItem->quantity - $item['quantity'];

                //
                if ($item['quantity'] == 0) {
                    $update = ItemsFifoCost::where('id', $fifoItem->id)
                        ->update([
                            'available_quantity' => 0,
                            'is_active' => false
                        ]);
                    $update = ItemsFifoCost::create([
                        'item_id' => $item['item_id'],
                        'invoice_id' => $item['invoice_id'],
                        'quantity' => $quantity,
                        'available_quantity' => 0,
                        'price' => $fifoItem->price,
                        'type' => AppConstant::TYPE_OUT,
                        'is_active' => false,
                        'fifo_cost' => $fifoItem->price,
                        'selling_price' => $item['selling_price']
                    ]);
                    break;
                }

                if ($item['quantity'] > 0) {
                    $update = ItemsFifoCost::where('id', $fifoItem->id)
                        ->update([
                            'quantity' => $item['quantity']
                        ]);
                    $update = ItemsFifoCost::create([
                        'item_id' => $item['item_id'],
                        'invoice_id' => $item['invoice_id'],
                        'quantity' => $quantity,
                        'available_quantity' => $item['quantity'],
                        'price' => $fifoItem->price,
                        'type' => AppConstant::TYPE_OUT,
                        'is_active' => false,
                        'fifo_cost' => $fifoItem->price,
                        'selling_price' => $item['selling_price']
                    ]);
                    break;
                }

                if ($item['quantity'] < 0) {
                    $item['quantity'] = $item['quantity'] * (-1);
                    $update = ItemsFifoCost::where('id', $fifoItem->id)
                        ->update([
                            'available_quantity' => 0,
                            'is_active' => false
                        ]);
                }
            }
    }

    public function lifo($item)
    {

        //all items that were out
//        foreach ($items as $item) {

            //items that are available
            $fifoItems = ItemsLifoCost::where('item_id', $item['item_id'])
                ->where('quantity', '>', 0)
                ->where('is_active', true)
                ->where('type', AppConstant::TYPE_IN)
                ->orderby('id', 'desc')
                ->get();

            //items list for fifo calculation
            foreach ($fifoItems as $fifoItem) {
                $quantity = $item['quantity'];
                $item['quantity'] = $fifoItem->quantity - $item['quantity'];
                if ($item['quantity'] == 0) {
                    $update = ItemsLifoCost::where('id', $fifoItem->id)
                        ->update([
                            'available_quantity' => 0,
                            'is_active' => false
                        ]);
                    $update = ItemsLifoCost::create([
                        'item_id' => $item['item_id'],
                        'invoice_id' => $item['invoice_id'],
                        'quantity' => $quantity,
                        'available_quantity' => $item['quantity'],
                        'price' => $fifoItem->price,
                        'type' => AppConstant::TYPE_OUT,
                        'is_active' => false,
                        'fifo_cost' => $fifoItem->price,
                        'selling_price' => $item['selling_price']
                    ]);
                    break;
                }
                if ($item['quantity'] > 0) {
                    $update = ItemsLifoCost::where('id', $fifoItem->id)
                        ->update([
                            'available_quantity' => $item['quantity']
                        ]);
                    $update = ItemsLifoCost::create([
                        'item_id' => $item['item_id'],
                        'invoice_id' => $item['invoice_id'],
                        'quantity' => $quantity,
                        'available_quantity' => $item['quantity'],
                        'price' => $fifoItem->price,
                        'type' => AppConstant::TYPE_OUT,
                        'is_active' => false,
                        'fifo_cost' => $fifoItem->price,
                        'selling_price' => $item['selling_price']
                    ]);
                    break;
                }
                if ($item['quantity'] < 0) {
                    $item['quantity'] = $item['quantity'] * (-1);
                    $update = ItemsLifoCost::where('id', $fifoItem->id)
                        ->update([
                            'available_quantity' => 0,
                            'is_active' => false
                        ]);

                }
            }

    }

    public function avg($item)
    {
        //all items that were out
//        foreach ($items as $item) {

            //items that are available
            $fifoItems = ItemsAvgCost::where('item_id', $item['item_id'])
                ->where('quantity', '>', 0)
                ->where('is_active', true)
                ->where('type', AppConstant::TYPE_IN);


            $itemCount = $fifoItems->count();
            $itemSum = $fifoItems->sum('price');

//        }

    }

    public function salesInwards($data)
    {

        DB::beginTransaction();

        try {
            $invoiceDetail = parent::create($data);
            $items = null;
            foreach ($data['data']['items'] as $item) {
                /** @var InvoiceItem $availableQuantity */
                $availableQuantity = InvoiceItem::where('item_id', $item['item_id'])->orderBy('id', 'desc')->first();
                $items = [
                    'store_id' => $data['data']['store_id'],
                    'item_id' => $item['item_id'],
                    'invoice_id' => $invoiceDetail->id,
                    'measurement_id' => $item['measurement_id'],
                    'description' => $item['description'],
                    'unit_price' => $item['unit_price'],
                    'unit_cost' => $item['unit_cost'],
                    'quantity' => $item['quantity'],
                    'available_balance' => $item['quantity'] + $availableQuantity->available_balance,
                    'created_at' => Carbon::now()->toDateString(),
                    'updated_at' => Carbon::now()->toDateString()
                ];
                $cost = [
                    'item_id' => $item['item_id'],
                    'invoice_id' => $invoiceDetail->id,
                    'quantity' => $item['quantity'],
                    'price' => $item['unit_price']
                ];
                $data['items'][] = $items;
            }

            InvoiceItem::insert($data['items']);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();
        return $invoiceDetail;
    }

    public function salesOutwards($data)
    {

        DB::beginTransaction();

        try {
            $invoiceDetail = parent::create($data);
            $items = null;
            foreach ($data['data']['items'] as $item) {
                /** @var InvoiceItem $availableQuantity */
                $availableQuantity = InvoiceItem::where('item_id', $item['item_id'])->orderBy('id', 'desc')->first();
                $items = [
                    'store_id' => $data['data']['store_id'],
                    'item_id' => $item['item_id'],
                    'invoice_id' => $invoiceDetail->id,
                    'measurement_id' => $item['measurement_id'],
                    'description' => $item['description'],
                    'selling_price' => $item['selling_price'],
                    'available_balance' => $availableQuantity->available_balance - $item['quantity'],
                    'quantity' => $item['quantity'],
                    'created_at' => Carbon::now()->toDateString(),
                    'updated_at' => Carbon::now()->toDateString()
                ];


                foreach ($item['taxes'] as $tax) {
                    $taxes = [
                        'invoice_id' => $invoiceDetail->id,
                        'item_id' => $item['item_id'],
                        'tax' => $tax['tax'],
                        'tax_id' => $tax['id']
                    ];
                    $data['taxes'][] = $taxes;
                }
                $data['items'][] = $items;


//                $data[''] =
                //fifo


                //lifo


                //avg

            }
            InvoiceItem::insert($data['items']);
            InvoiceTax::insert($data['taxes']);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();
        return $invoiceDetail;
    }

    public function storeInwards($data)
    {

        DB::beginTransaction();

        try {
            $invoiceDetail = parent::create($data);
            $items = null;
            foreach ($data['data']['items'] as $item) {
                /** @var InvoiceItem $availableQuantity */
                $availableQuantity = InvoiceItem::where('item_id', $item['item_id'])->orderBy('id', 'desc')->first();
                $items = [
                    'store_id' => $data['data']['store_id'],
                    'item_id' => $item['item_id'],
                    'invoice_id' => $invoiceDetail->id,
                    'description' => $item['description'],
                    'measurement_id' => $item['measurement_id'],
                    'account_code' => $item['account_code'],
                    'quantity' => $item['quantity'],
                    'available_balance' => $item['quantity'] + $availableQuantity->available_balance,
                    'created_at' => Carbon::now()->toDateString(),
                    'updated_at' => Carbon::now()->toDateString()
                ];
                $data['items'][] = $items;
            }
            InvoiceItem::insert($data['items']);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();
        return $invoiceDetail;
    }

    public function storeOutwards($data)
    {

        DB::beginTransaction();

        try {
            $invoiceDetail = parent::create($data);
            $items = null;
            foreach ($data['data']['items'] as $item) {
                /** @var InvoiceItem $availableQuantity */
                $availableQuantity = InvoiceItem::where('item_id', $item['item_id'])->orderBy('id', 'desc')->first();
                $items = [
                    'store_id' => $data['data']['store_id'],
                    'item_id' => $item['item_id'],
                    'invoice_id' => $invoiceDetail->id,
                    'measurement_id' => $item['measurement_id'],
                    'description' => $item['description'],
                    'account_code' => $item['account_code'],
                    'quantity' => $item['quantity'],
                    'available_balance' => $availableQuantity->available_balance - $item['quantity'],
                    'created_at' => Carbon::now()->toDateString(),
                    'updated_at' => Carbon::now()->toDateString()
                ];
                $data['items'][] = $items;
            }
            InvoiceItem::insert($data['items']);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();
        return $invoiceDetail;
    }

    public function srvDonation($data)
    {

        DB::beginTransaction();

        try {
            $invoiceDetail = parent::create($data);
            $items = null;
            foreach ($data['data']['items'] as $item) {
                /** @var InvoiceItem $availableQuantity */
                $availableQuantity = InvoiceItem::where('item_id', $item['item_id'])->orderBy('id', 'desc')->first();
                $items = [
                    'store_id' => $data['data']['store_id'],
                    'item_id' => $item['item_id'],
                    'invoice_id' => $invoiceDetail->id,
                    'measurement_id' => $item['measurement_id'],
                    'description' => $item['description'],
                    'unit_cost' => $item['unit_cost'],
                    'quantity' => $item['quantity'],
                    'available_balance' => $item['quantity'] + $availableQuantity->available_balance,
                    'created_at' => Carbon::now()->toDateString(),
                    'updated_at' => Carbon::now()->toDateString()
                ];
                $data['items'][] = $items;
            }
            InvoiceItem::insert($data['items']);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();
        return $invoiceDetail;
    }

    public function storeAdjustment($data)
    {

        DB::beginTransaction();

        try {
            $invoiceDetail = parent::create($data);
            $items = null;
            foreach ($data['data']['items'] as $item) {
                /** @var InvoiceItem $availableQuantity */
                $availableQuantity = InvoiceItem::where('item_id', $item['item_id'])->orderBy('id', 'desc')->first();
                $items = [
                    'store_id' => $data['data']['store_id'],
                    'item_id' => $item['item_id'],
                    'measurement_id' => $item['measurement_id'],
                    'invoice_id' => $invoiceDetail->id,
                    'description' => $item['description'],
                    'unit_cost' => $item['unit_cost'],
                    'quantity' => $item['quantity'],
                    'available_balance' => $item['quantity'] + $availableQuantity->available_balance,
                    'created_at' => Carbon::now()->toDateString(),
                    'updated_at' => Carbon::now()->toDateString()
                ];
                $data['items'][] = $items;
            }
            InvoiceItem::insert($data['items']);

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();
        return $invoiceDetail;
    }

    public function storeTransfer($data)
    {

        DB::beginTransaction();

        try {
            $invoiceDetail = parent::create($data);
            $items = null;
            foreach ($data['data']['items'] as $item) {
                /** @var InvoiceItem $availableQuantity */
                $availableQuantity = InvoiceItem::where('item_id', $item['item_id'])->orderBy('id', 'desc')->first();
                $items = [
                    'store_id' => $data['data']['store_id'],
                    'measurement_id' => $item['measurement_id'],
                    'item_id' => $item['item_id'],
                    'invoice_id' => $invoiceDetail->id,
                    'description' => $item['description'],
                    'account_code' => $item['account_code'],
                    'quantity' => $item['quantity'],
                    'available_balance' => $availableQuantity->available_balance - $item['quantity'],
                    'created_at' => Carbon::now()->toDateString(),
                    'updated_at' => Carbon::now()->toDateString()
                ];
                $data['items'][] = $items;
            }
            InvoiceItem::insert($data['items']);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();
        return $invoiceDetail;
    }


    public function inventoryLedgerReport($params)
    {

        $query = DB::table('inventory_invoice_details as iid')
            ->join('inventory_invoice_items as iii', 'iid.id', '=', 'iii.invoice_id')
            ->join('inventory_items as ii', 'ii.id', '=', 'iii.item_id')
            ->select('iid.date', 'ii.description as item_description', 'iii.item_id as item_id', 'iii.available_balance', 'iii.unit_cost', 'iid.type', 'iii.store_id');


        if (isset($params['inputs']['store_id'])) {
            $query->where('iii.store_id', $params['inputs']['store_id']);
        }

        if (isset($params['inputs']['item_id'])) {
            $query->where('iii.item_id', $params['inputs']['item_id']);
        }

        if (isset($params['inputs']['from_date']) && isset($params['inputs']['to_date'])) {
            $fromDate = Carbon::parse($params['inputs']['from_date'])->toDateTimeString();
            $toDate = Carbon::parse($params['inputs']['to_date'])->toDateString() . ' 23:59:59';

            $query->whereDate('iid.date', '>=', $fromDate)
                ->whereDate('iid.date', '<=', $toDate);
        }

        $costingQuery = clone $query;
        $avgFifo = 0;
        $itemCost = 0;
        if (isset($params['inputs']['preferred_costing'])) {
//            if ($params['inputs']['preferred_costing'] == 'FIFO') {
//                foreach ($costingQuery as $item) {
//                    $data = (array)$item;
//                    $itemCost[$item->item_id] = [
//                    ];
//                }
//            } elseif ($params['inputs']['preferred_costing'] == 'LIFO') {
//
//            } elseif ($params['inputs']['preferred_costing'] == 'AVG') {
//                foreach ($costingQuery->get() as $item) {
//                    $data = (array)$item;
////                    dd($item);
//                    $avgFifo = $avgFifo + $item->unit_cost;
//                    $itemCost[$item->item_id] = [
//                        $avgFifo
//                    ];
//                }
//            }

        }

        dd($itemCost);
    }

    public function inventoryQualityBalance($params)
    {
        // apply limit  or offset in this query
        $items = DB::table('inventory_invoice_items')
            ->selectRaw('item_id, MAX(id) as id')
            ->groupBy('item_id')
            ->pluck('id')->toArray();


        $query = DB::table('inventory_invoice_details as iid')
            ->join('inventory_invoice_items as iii', 'iid.id', '=', 'iii.invoice_id')
            ->join('inventory_items as ii', 'ii.id', '=', 'iii.item_id')
            ->join('inventory_measurements as im', 'im.id', '=', 'iii.measurement_id')
            ->selectRaw('iii.item_id, ii.description as item_description, iii.item_id as item_id, iii.available_balance, iii.measurement_id, im.name as measurement_name, iii.unit_cost, iid.type, iii.store_id');
//            ->whereIn('iii.id', $items);


        if (isset($params['inputs']['store_id'])) {
            $query->where('iii.store_id', $params['inputs']['store_id']);
        }

        if (isset($params['inputs']['from_date']) && isset($params['inputs']['to_date'])) {
            $fromDate = Carbon::parse($params['inputs']['from_date'])->toDateTimeString();
            $toDate = Carbon::parse($params['inputs']['to_date'])->toDateString() . ' 23:59:59';
            $query->whereDate('iid.date', '>=', $fromDate)
                ->whereDate('iid.date', '<=', $toDate);
        }


//        $costingQuery = clone $query;

//        if (isset($params['inputs']['preferred_costing'])) {
//            if ($params['inputs']['preferred_costing'] == 'FIFO') {
//                foreach ($query->get() as $item) {
//
//                }
//            } elseif ($params['inputs']['preferred_costing'] == 'LIFO') {
//
//
//            } elseif ($params['inputs']['preferred_costing'] == 'AVG') {
//
//            }
//
//        }

        dd($query->get());
        $query = $query->whereIn('iii.id', $items);

    }

    public function binCardReport($params = [], $query = null)
    {
        $query = DB::table('inventory_invoice_details')
            ->join('inventory_invoice_items', 'inventory_invoice_details.id', '=', 'inventory_invoice_items.invoice_id')
            ->join('inventory_items', 'inventory_items.id', '=', 'inventory_invoice_items.item_id')
            ->select(
                'inventory_invoice_details.id',
                'inventory_invoice_details.date',
                'inventory_invoice_details.type',
                'inventory_invoice_items.unit_cost',
                'inventory_items.description as desc',
                'inventory_invoice_items.available_balance as balance'
            );
        if (isset($params['inputs']['store_id'])) {
            $query->where('inventory_invoice_details.store_id', '=', $params['inputs']['store_id']);
        }

        if (isset($params['inputs']['item_id'])) {
            $query->where('inventory_invoice_items.item_id', '=', $params['inputs']['item_id']);
        }

        if (isset($params['inputs']['from_date']) && isset($params['inputs']['to_date'])) {
            $query->whereBetween('inventory_invoice_details.date', [$params['inputs']['from_date'], $params['inputs']['to_date']]);
        }
        return $query->get();
    }

    public function offLevelReport($params)
    {
        $query = null;
        $items = DB::table('inventory_invoice_items')
            ->selectRaw('item_id, MAX(id) as id')
            ->groupBy('item_id')
            ->pluck('id')->toArray();

        $query = DB::table('inventory_invoice_items')
            ->join('inventory_stores', 'inventory_invoice_items.store_id', '=', 'inventory_stores.id')
            ->join('inventory_items', 'inventory_invoice_items.item_id', '=', 'inventory_items.id')
            ->join('inventory_measurements', 'inventory_invoice_items.measurement_id', '=', 'inventory_measurements.id')
            ->selectRaw(
                'inventory_items.id as itemCode, inventory_items.description as itemDescription, inventory_items.reorder_quantity, inventory_items.minimum_quantity, inventory_items.maximum_quantity, inventory_invoice_items.available_balance as onHand, inventory_measurements.name as unitOfMeasure, inventory_stores.name as storeName, inventory_invoice_items.item_id as item_id, inventory_invoice_items.store_id as store_id')
            ->whereRaw('inventory_invoice_items.available_balance <= inventory_items.minimum_quantity')
            ->whereIn('inventory_invoice_items.id', $items);

        if (isset($params['inputs']['report_preference'])) {
            if ($params['inputs']['report_preference'] == 'MIN_ORDER') {
                $query->whereRaw('inventory_invoice_items.available_balance <= inventory_items.minimum_quantity')
                    ->whereIn('inventory_invoice_items.id', $items);
            }
            if ($params['inputs']['report_preference'] == 'MAX_ORDER') {
                $query->whereRaw('inventory_invoice_items.available_balance >= inventory_items.maximum_quantity')
                    ->whereIn('inventory_invoice_items.id', $items);
            }
            if ($params['inputs']['report_preference'] == 'RE_ORDER') {
                $query->whereRaw('inventory_invoice_items.available_balance <= inventory_items.reorder_quantity')
                    ->whereIn('inventory_invoice_items.id', $items);
            }
        }
        if (isset($params['inputs']['store_item'])) {
            $query
                ->where('inventory_invoice_items.item_id', '=', $params['inputs']['store_item']);
        }
        if (isset($params['inputs']['store_id'])) {
            $query
                ->where('inventory_invoice_items.store_id', '=', $params['inputs']['store_id']);
        }
        return $query->get();
    }
}

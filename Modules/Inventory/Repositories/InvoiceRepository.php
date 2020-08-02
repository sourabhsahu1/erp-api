<?php


namespace Modules\Inventory\Repositories;


use App\Constants\AppConstant;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Inventory\Models\InvoiceDetail;
use Modules\Inventory\Models\InvoiceItem;
use Modules\Inventory\Models\InvoiceTax;
use Modules\Inventory\Models\ItemsAvgCost;
use Modules\Inventory\Models\ItemsFifoCost;
use Modules\Inventory\Models\ItemsLifoCost;
use Modules\Inventory\Models\StoreItem;

class InvoiceRepository extends EloquentBaseRepository
{
    public $model = InvoiceDetail::class;


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
            $this->storeItems($invoiceDetail->id, AppConstant::TYPE_OUT);

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();

        return $invoiceDetail;
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
            $this->storeItems($invoiceDetail->id, AppConstant::TYPE_IN);
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
            $this->storeItems($invoiceDetail->id, AppConstant::TYPE_IN);
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
            $this->storeItems($invoiceDetail->id, AppConstant::TYPE_IN);
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
            $this->storeItems($invoiceDetail->id, AppConstant::TYPE_IN);
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
            $this->storeItems($invoiceDetail->id, AppConstant::TYPE_IN);
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
            $this->storeItems($invoiceDetail->id, AppConstant::TYPE_OUT);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();
        return $invoiceDetail;
    }

    public function inventoryLedgerReport($params)
    {
        $params['inputs']['orderby'] = 'created_at';
        $params['inputs']['order'] = 'ASC';
        $params['inputs']['costing_method'] = $params['inputs']['costing_method'] ?? AppConstant::COSTING_METHOD_LIFO;
        $query = InvoiceDetail::query();
        $costingMethodKey = 'lifo';
        switch ($params['inputs']['costing_method']) {
            case AppConstant::COSTING_METHOD_LIFO:
                $costingMethodKey = 'lifo';
                break;
            case AppConstant::COSTING_METHOD_FIFO:
                $costingMethodKey = 'fifo';
                break;
            case AppConstant::COSTING_METHOD_AVG:
                $costingMethodKey = 'avg';
                break;
        }

        if (isset($params['inputs']['item_id'])) {
            $query->whereHas('invoice_items', function ($q) use ($params, $costingMethodKey) {
                $q->where('item_id', $params['inputs']['item_id']);
            })->with(['invoice_items' => function ($q) use ($params, $costingMethodKey) {
                $q->where('item_id', $params['inputs']['item_id'])->with($costingMethodKey);
            }]);
        }
        if (isset($params['inputs']['opening_date'])) {
            $query->whereDate('date', '>=', Carbon::parse($params['inputs']['opening_date']));
        }
        if (isset($params['inputs']['closing_date'])) {
            $query->whereDate('date', '<=', Carbon::parse($params['inputs']['closing_date']));
        }

        $data = parent::getAll($params, $query);

        $updatedData = [];

        // iterating invoice to get items and its lifo children
        foreach ($data['items'] as $invoice) {
            // children is for analysis
            $children = [];
            $parent = [
                'type' => $invoice['type'],
                'date' => $invoice['date'],
                'details' => $invoice['detail'],
                'in_qty' => null,
                'in_unit_price' => null,
                'in_value' => null,
                'out_qty' => null,
                'out_unit_price' => null,
                'out_value' => null,
                'balance_qty' => 0,
                'balance_unit_price' => "-",
                'balance_value' => 0,
            ];

            // iterating invoice items to populate lifo cost
            foreach ($invoice['invoice_items'] as $invoiceItem) {
                // defining key on the basis of IN and OUT of invoice
                $qtyKey = 'in_qty';
                $unitPriceKey = 'in_unit_price';
                $valueKey = 'in_value';
                if ($invoice['type'] == AppConstant::TYPE_OUT) {
                    $qtyKey = 'out_qty';
                    $unitPriceKey = "out_unit_price";
                    $valueKey = "out_value";
                }
                $parent[$qtyKey] = $invoiceItem['quantity'];
                $parent[$unitPriceKey] = $invoiceItem['unit_cost'] ?? $invoiceItem['selling_price'];
                $parent[$valueKey] = $parent[$qtyKey] * $parent[$unitPriceKey];
                $inIndex = 0;
                $outIndex = 0;
                /*
                 * Adding analysis data
                 * adding data in children variable and then adding this variable in the main item array
                 *
                 * we are merging IN and OUT value to create single row for analysis
                */
                foreach ($invoiceItem[$costingMethodKey] as $lifo) {
                    $currentIndex = $inIndex++;
                    $child = [
                        'type' => null,
                        'date' => null,
                        'details' => null,
                        'in_qty' => null,
                        'in_unit_price' => null,
                        'in_value' => null,
                        'out_qty' => null,
                        'out_unit_price' => null,
                        'out_value' => null,
                        'balance_qty' => null,
                        'balance_unit_price' => null,
                        'balance_value' => null,
                    ];
                    $qtyKey = 'balance_qty';
                    $unitPriceKey = "balance_unit_price";
                    $valueKey = "balance_value";
                    if ($lifo['type'] == AppConstant::TYPE_OUT) {
                        $inIndex--;
                        $currentIndex = $outIndex;
                        $outIndex++;
                        $qtyKey = 'out_qty';
                        $unitPriceKey = "out_unit_price";
                        $valueKey = "out_value";
                    }
                    if (count($children) > $currentIndex) {
                        $child = $children[$currentIndex];
                    }
                    $child[$qtyKey] = $lifo['quantity'];
                    $child[$unitPriceKey] = $lifo['unit_price'];
                    $child[$valueKey] = $lifo['price'];
                    $children[$currentIndex] = $child;

                    // If item type is IN then add quantity and value in parent ($parent) row
                    if ($lifo['type'] == AppConstant::TYPE_IN) {
                        $parent['balance_qty'] += $lifo['quantity'];
                        $parent['balance_value'] += $lifo['price'];
                    }
                }
            }

            $updatedData[] = $parent;
            if (count($children)) {
                $updatedData = array_merge($updatedData, $children);
            }
        }
        $data['items'] = $updatedData;

        return $data;
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
            ->selectRaw('iii.item_id,ii.reorder_quantity,ii.minimum_quantity,ii.maximum_quantity,  ii.description as item_description, iii.item_id as item_id, iii.available_balance, iii.measurement_id, im.name as measurement_name, iii.unit_cost, iid.type, iii.store_id');


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

        $query = $query->whereIn('iii.id', $items)->get();
        return $query;
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

        if (isset($params['inputs']['opening_date']) && isset($params['inputs']['closing_date'])) {
            $query->whereBetween('inventory_invoice_details.date', [$params['inputs']['opening_date'], $params['inputs']['closing_date']]);
        }
        return $query->get();
    }

//    public function offLevelReport($params)
//    {
//        $query = null;
//        $items = DB::table('inventory_invoice_items')
//            ->selectRaw('item_id, MAX(id) as id')
//            ->groupBy('item_id')
//            ->pluck('id')->toArray();
////        dd($items);
//
//        $query = DB::table('inventory_invoice_items')
//            ->join('inventory_stores', 'inventory_invoice_items.store_id', '=', 'inventory_stores.id')
//            ->join('inventory_items', 'inventory_invoice_items.item_id', '=', 'inventory_items.id')
//            ->join('inventory_measurements', 'inventory_invoice_items.measurement_id', '=', 'inventory_measurements.id')
//            ->selectRaw(
//                'inventory_items.id as itemCode, inventory_items.description as itemDescription, inventory_items.reorder_quantity, inventory_items.minimum_quantity, inventory_items.maximum_quantity, inventory_invoice_items.available_balance as onHand, inventory_measurements.name as unitOfMeasure, inventory_stores.name as storeName, inventory_invoice_items.item_id as item_id, inventory_invoice_items.store_id as store_id');
//
//        if (isset($params['inputs']['report_preference'])) {
//            if ($params['inputs']['report_preference'] == 'MIN_ORDER') {
//                $query->whereRaw('inventory_invoice_items.available_balance <= inventory_items.minimum_quantity')
//                    ->whereIn('inventory_invoice_items.id', $items);
//            }
//            if ($params['inputs']['report_preference'] == 'MAX_ORDER') {
//                $query->whereRaw('inventory_invoice_items.available_balance >= inventory_items.maximum_quantity')
//                    ->whereIn('inventory_invoice_items.id', $items);
//            }
//            if ($params['inputs']['report_preference'] == 'RE_ORDER') {
//                $query->whereRaw('inventory_invoice_items.available_balance <= inventory_items.reorder_quantity')
//                    ->whereIn('inventory_invoice_items.id', $items);
//            }
//        }
//        if (isset($params['inputs']['store_item'])) {
//            $query
//                ->where('inventory_invoice_items.item_id', '=', $params['inputs']['store_item']);
//        }
//        if (isset($params['inputs']['store_id'])) {
//            $query
//                ->where('inventory_invoice_items.store_id', '=', $params['inputs']['store_id']);
//        }
//        return $query->get();
//    }


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
            ->select(
                'inventory_items.id as itemCode',
                'inventory_items.description as itemDescription',//add level and  on hand
                'inventory_items.reorder_quantity',
                'inventory_items.minimum_quantity',
                'inventory_items.maximum_quantity',
                'inventory_invoice_items.available_balance as onHand',
                'inventory_measurements.name as unitOfMeasure',
                'inventory_stores.name as storeName',
                'inventory_invoice_items.item_id as item_id',
                'inventory_invoice_items.store_id as store_id'

            );
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

    // data in
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

                foreach ($item['taxes'] as $tax) {
                    $itemTaxes = InvoiceTax::create([
                        'invoice_id' => $invoiceDetail->id,
                        'item_id' => $item['item_id'],
                        'tax' => $tax['tax'],
                        'tax_id' => $tax['id']
                    ]);

                }
            }
            $this->lifo($invoiceDetail->id, AppConstant::TYPE_IN);
            $this->fifo($invoiceDetail->id, AppConstant::TYPE_IN);
            $this->avg($invoiceDetail->id, AppConstant::TYPE_IN);
            $this->storeItems($invoiceDetail->id, AppConstant::TYPE_IN);
            DB::commit();

            return $invoiceDetail;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    // data out
    public function salesOutwards($data)
    {
        // todo check for quantity is available or not
        DB::beginTransaction();

        try {
            $invoiceDetail = parent::create($data);
            $items = null;
            $invoiceDbItems = [];
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

            }
            InvoiceItem::insert($data['items']);
            InvoiceTax::insert($data['taxes']);
            $this->lifo($invoiceDetail->id, AppConstant::TYPE_OUT);
            $this->fifo($invoiceDetail->id, AppConstant::TYPE_OUT);
            $this->avg($invoiceDetail->id, AppConstant::TYPE_OUT);
            $this->storeItems($invoiceDetail->id, AppConstant::TYPE_OUT);
            DB::commit();
            return $invoiceDetail;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function lifo($invoiceId, $type)
    {
        $items = InvoiceItem::where('invoice_id', $invoiceId)->get()->toArray();

        foreach ($items as $item) {
            // get last active batch to calculate cost
            $lastBatch = ItemsLifoCost::where('is_active', true)
                ->where('type', AppConstant::TYPE_IN)
                ->where('item_id', $item['item_id'])
                ->get()->toArray();
            $dataToBeInserted = [];

            // if it's in then add it
            // else subtract the data
            if ($type === AppConstant::TYPE_IN) {
                foreach ($lastBatch as $batch) {
                    unset($batch['id']);
                    unset($batch['created_at']);
                    unset($batch['updated_at']);
                    $batch['invoice_item_id'] = $item['id'];
                    $batch['created_at'] = Carbon::now();
                    $batch['updated_at'] = Carbon::now();
                    $dataToBeInserted[] = $batch;
                }
                $dataToBeInserted[] = [
                    'item_id' => $item['item_id'],
                    'invoice_item_id' => $item['id'],
                    'invoice_id' => $item['invoice_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_cost'],
                    'price' => $item['quantity'] * $item['unit_cost'],
                    'type' => $type,
                    'is_active' => true,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
            } else {
                $activeItems = ItemsLifoCost::where('is_active', true)
                    ->where('type', AppConstant::TYPE_IN)
                    ->where('item_id', $item['item_id'])
                    ->orderBy('id', 'DESC')->get()->toArray();

                $deletedIds = [];
                $activeItemQtyMap = [];
                $activeQty = $item['quantity'];

                foreach ($activeItems as $activeItem) {
                    if ($activeQty >= $activeItem['quantity']) {
                        $deletedIds[] = $activeItem['id'];
                        $activeQty -= $activeItem['quantity'];
                        unset($activeItem['id']);
                        $activeItem['type'] = AppConstant::TYPE_OUT;
                        $activeItem['is_active'] = false;
                        $activeItem['invoice_item_id'] = $item['id'];
                        $dataToBeInserted[] = $activeItem;
                        if ($activeQty <= 0) {
                            break;
                        }
                    } else {
                        $activeItemQtyMap[$activeItem['id']] = $activeItem['quantity'] - $activeQty;
                        unset($activeItem['id']);
                        $activeItem['type'] = AppConstant::TYPE_OUT;
                        $activeItem['quantity'] = $activeQty;
                        $activeItem['is_active'] = false;
                        $activeItem['invoice_item_id'] = $item['id'];
                        $activeItem['unit_price'] = $item['selling_price'];
                        $activeItem['price'] = $activeQty * $item['selling_price'];
                        $dataToBeInserted[] = $activeItem;
                        break;
                    }
                }

                foreach ($lastBatch as &$batch) {
                    if (array_search($batch['id'], $deletedIds) !== false) {
                        continue;
                    }
                    if (isset($activeItemQtyMap[$batch['id']])) {
                        $batch['quantity'] = $activeItemQtyMap[$batch['id']];
                        $batch['price'] = $batch['quantity'] * $batch['unit_price'];
                    }
                    unset($batch['id']);
                    unset($batch['created_at']);
                    unset($batch['updated_at']);
                    $batch['invoice_item_id'] = $item['id'];
                    $batch['created_at'] = Carbon::now();
                    $batch['updated_at'] = Carbon::now();
                    $dataToBeInserted[] = $batch;
                }
            }
            ItemsLifoCost::where('is_active', true)
                ->where('item_id', $item['item_id'])
                ->update(['is_active' => false]);

            ItemsLifoCost::insert($dataToBeInserted);
        }

    }

    public function storeItems($invoiceId, $type)
    {
        $items = InvoiceItem::where('invoice_id', $invoiceId)->get();

        foreach ($items as $item) {
            $storeItem = StoreItem::where('store_id', $item->store_id)
                ->where('item_id', $item->item_id)->first();

            if ($type == AppConstant::TYPE_IN) {
                if (is_null($storeItem)) {
                    $storeItem = StoreItem::create([
                        'store_id' => $item->store_id,
                        'item_id' => $item->item_id,
                        'available_quantity' => $item->quantity
                    ]);
                } else {
                    StoreItem::where('store_id', $item->store_id)
                        ->where('item_id', $item->item_id)->update([
                            'available_quantity' => $storeItem->available_quantity + $item->quantity
                        ]);
                }
            } elseif ($type == AppConstant::TYPE_OUT) {

                if (!is_null($storeItem)) {
                    StoreItem::where('store_id', $item->store_id)
                        ->where('item_id', $item->item_id)->update([
                            'available_quantity' => $storeItem->available_quantity - $item->quantity
                        ]);
                } else {
                    throw new AppException('no items');
                }

            }

        }
    }

    public function storeAvailableItems($params)
    {
        if (isset($params['inputs']['item_id']) && isset($params['inputs']['store_id'])) {
            $store = StoreItem::where('store_id', $params['inputs']['store_id'])
                ->where('item_id', $params['inputs']['item_id'])->first();
            return $store;
        } else {
            throw new AppException("itemId and storeId is required");
        }

    }

    public function fifo($invoiceId, $type)
    {
        $items = InvoiceItem::where('invoice_id', $invoiceId)->get()->toArray();

        foreach ($items as $item) {
            // get last active batch to calculate cost
            $lastBatch = ItemsFifoCost::where('is_active', true)
                ->where('type', AppConstant::TYPE_IN)
                ->where('item_id', $item['item_id'])
                ->get()->toArray();
            $dataToBeInserted = [];

            // if it's in then add it
            // else subtract the data
            if ($type === AppConstant::TYPE_IN) {
                foreach ($lastBatch as $batch) {
                    unset($batch['id']);
                    unset($batch['created_at']);
                    unset($batch['updated_at']);
                    $batch['invoice_item_id'] = $item['id'];
                    $batch['created_at'] = Carbon::now();
                    $batch['updated_at'] = Carbon::now();
                    $dataToBeInserted[] = $batch;
                }
                $dataToBeInserted[] = [
                    'item_id' => $item['item_id'],
                    'invoice_item_id' => $item['id'],
                    'invoice_id' => $item['invoice_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_cost'],
                    'price' => $item['quantity'] * $item['unit_cost'],
                    'type' => $type,
                    'is_active' => true,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
            } else {
                $activeItems = ItemsFifoCost::where('is_active', true)
                    ->where('type', AppConstant::TYPE_IN)
                    ->where('item_id', $item['item_id'])
                    ->orderBy('id', 'ASC')->get()->toArray();

                $deletedIds = [];
                $activeItemQtyMap = [];
                $activeQty = $item['quantity'];

                foreach ($activeItems as $activeItem) {
                    if ($activeQty >= $activeItem['quantity']) {
                        $deletedIds[] = $activeItem['id'];
                        $activeQty -= $activeItem['quantity'];
                        unset($activeItem['id']);
                        $activeItem['type'] = AppConstant::TYPE_OUT;
                        $activeItem['is_active'] = false;
                        $activeItem['invoice_item_id'] = $item['id'];
                        $dataToBeInserted[] = $activeItem;
                        if ($activeQty <= 0) {
                            break;
                        }
                    } else {
                        $activeItemQtyMap[$activeItem['id']] = $activeItem['quantity'] - $activeQty;
                        unset($activeItem['id']);
                        $activeItem['type'] = AppConstant::TYPE_OUT;
                        $activeItem['quantity'] = $activeQty;
                        $activeItem['is_active'] = false;
                        $activeItem['invoice_item_id'] = $item['id'];
                        $activeItem['unit_price'] = $item['selling_price'];
                        $activeItem['price'] = $activeQty * $item['selling_price'];
                        $dataToBeInserted[] = $activeItem;
                        break;
                    }
                }

                foreach ($lastBatch as &$batch) {
                    if (array_search($batch['id'], $deletedIds) !== false) {
                        continue;
                    }
                    if (isset($activeItemQtyMap[$batch['id']])) {
                        $batch['quantity'] = $activeItemQtyMap[$batch['id']];
                        $batch['price'] = $batch['quantity'] * $batch['unit_price'];
                    }
                    unset($batch['id']);
                    unset($batch['created_at']);
                    unset($batch['updated_at']);
                    $batch['invoice_item_id'] = $item['id'];
                    $batch['created_at'] = Carbon::now();
                    $batch['updated_at'] = Carbon::now();
                    $dataToBeInserted[] = $batch;
                }
            }
            ItemsFifoCost::where('is_active', true)
                ->where('item_id', $item['item_id'])
                ->update(['is_active' => false]);

            ItemsFifoCost::insert($dataToBeInserted);
        }

    }

    public function avg($invoiceId, $type)
    {
        $items = InvoiceItem::where('invoice_id', $invoiceId)->get()->toArray();

        foreach ($items as $item) {
            // get last active batch to calculate cost
            $lastBatch = ItemsAvgCost::where('is_active', true)
                ->where('type', AppConstant::TYPE_IN)
                ->where('item_id', $item['item_id'])
                ->first();

            if ($lastBatch) {
                $lastBatch = $lastBatch->toArray();
            } else {
                $lastBatch = ['quantity' => 0, 'unit_cost' => 0];
            }

            $dataToBeInserted = [];

            // if it's in then add it
            // else subtract the data
            if ($type === AppConstant::TYPE_IN) {
                $d = [
                    'item_id' => $item['item_id'],
                    'invoice_item_id' => $item['id'],
                    'invoice_id' => $item['invoice_id'],
                    'quantity' => $lastBatch['quantity'] + $item['quantity'],
                    'unit_price' => 0,
                    'price' => 0,
                    'type' => $type,
                    'is_active' => true,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
                $d['unit_price'] = round(((($item['quantity'] * $item['unit_cost']) + ($lastBatch['quantity'] * $lastBatch['unit_price'])) / $d['quantity']), 2);
                $d['price'] = $d['quantity']  * $d['unit_price'];
                $dataToBeInserted[] = $d;
            } else {
                unset($lastBatch['id']);
                unset($lastBatch['created_at']);
                unset($lastBatch['updated_at']);
                $lastBatch['invoice_item_id'] = $item['id'];
                $lastBatch['quantity'] -= $item['quantity'];
                $lastBatch['price'] = $lastBatch['quantity'] * $lastBatch['unit_price'];
                $lastBatch['created_at'] = Carbon::now();
                $lastBatch['updated_at'] = Carbon::now();
                $dataToBeInserted[] = $lastBatch;
            }

            ItemsAvgCost::where('is_active', true)
                ->where('item_id', $item['item_id'])
                ->update(['is_active' => false]);

            ItemsAvgCost::insert($dataToBeInserted);
        }
    }

}

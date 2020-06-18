<?php


namespace Modules\Inventory\Repositories;


use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Inventory\Models\InvoiceDetail;
use Modules\Inventory\Models\InvoiceItem;
use Modules\Inventory\Models\InvoiceTax;

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
//                dd($availableQuantity);
                $items = [
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
                $items = [
                    'store_id' => $data['data']['store_id'],
                    'item_id' => $item['item_id'],
                    'invoice_id' => $invoiceDetail->id,
                    'measurement_id' => $item['measurement_id'],
                    'description' => $item['description'],
                    'unit_cost' => $item['unit_cost'],
                    'unit_price' => $item['unit_price'],
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
            ->select('iid.date', 'ii.description as item_description', 'iii.item_id as item_id', 'iii.available_balance', 'iii.unit_price', 'iii.unit_cost', 'iid.type', 'iii.store_id');


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


        if (isset($params['inputs']['preferred_costing'])) {
            if ($params['inputs']['preferred_costing'] == 'FIFO') {

                foreach ($costingQuery as $item) {

                }
            } elseif ($params['inputs']['preferred_costing'] == 'LIFO') {

            } elseif ($params['inputs']['preferred_costing'] == 'AVG') {

            }

        }

    }

    public function inventoryQualityBalance($params)
    {
        // apply limit  or offset in this query
        $items = DB::table('inventory_invoice_items')
            ->selectRaw('item_id, MAX(id) as id')
            ->groupBy('item_id')
            ->pluck('id')->toArray();


        // Get full details
//        $query = DB::table('inventory_invoice_details as iid')
//            ->join('inventory_invoice_items as iii', 'iid.id', '=', 'iii.invoice_id')
////            ->join('inventory_items as ii', 'ii.id', '=', 'iii.item_id')
////            ->join('inventory_measurements as im', 'im.id', '=', 'iii.measurement_id')
//            ->selectRaw('ii.description as item_description, iii.item_id as item_id, iii.available_balance, iii.measurement_id, im.name as measurement_name, iii.unit_price, iii.unit_cost, iid.type, iii.store_id')
//            ->whereIn('iii.item_id', $items);
//
//        dd($items, $query->get());


        $query = DB::table('inventory_invoice_details as iid')
            ->join('inventory_invoice_items as iii', 'iid.id', '=', 'iii.invoice_id')
            ->join('inventory_items as ii', 'ii.id', '=', 'iii.item_id')
            ->join('inventory_measurements as im', 'im.id', '=', 'iii.measurement_id')
            ->selectRaw('ii.description as item_description, iii.item_id as item_id, iii.available_balance, iii.measurement_id, im.name as measurement_name, iii.unit_price, iii.unit_cost, iid.type, iii.store_id')
            ->whereIn('iii.item_id', $items);

        dd($query->get());


        if (isset($params['inputs']['store_id'])) {
            $query->where('iii.store_id', $params['inputs']['store_id']);
        }

        if (isset($params['inputs']['from_date']) && isset($params['inputs']['to_date'])) {
            $fromDate = Carbon::parse($params['inputs']['from_date'])->toDateTimeString();
            $toDate = Carbon::parse($params['inputs']['to_date'])->toDateString() . ' 23:59:59';

            $query->whereDate('iid.date', '>=', $fromDate)
                ->whereDate('iid.date', '<=', $toDate);
        }

        dd($query->toSql());
    }

    public function binCardReport($params = [], $query = null)
    {
        $query=DB::table('inventory_invoice_details')
            ->join('inventory_invoice_items','inventory_invoice_details.id','=','inventory_invoice_items.invoice_id')
            ->join('inventory_items','inventory_items.id','=','inventory_invoice_items.item_id')
            ->select(
                'inventory_invoice_details.id',
                'inventory_invoice_details.date',
                'inventory_invoice_details.type',
                'inventory_invoice_items.unit_cost',
                'inventory_items.description as desc',
                'inventory_invoice_items.available_balance as balance'
            )
            // ->where('inventory_invoice_details.store_id','=',$params['inputs']['store_id'])
            // ->orWhere('inventory_invoice_items.item_id','=',$params['inputs']['item_id'])
            //->orWhereBetween('inventory_invoice_details.date',[$params['inputs']['from_date'],$params['inputs']['to_date']]);
        ;
        if(isset($params['inputs']['store_id'])) {
            $query->where('inventory_invoice_details.store_id','=',$params['inputs']['store_id']);
        }

        if(isset($params['inputs']['item_id'])) {
            $query->where('inventory_invoice_items.item_id','=',$params['inputs']['item_id']);
        }

        if(isset($params['inputs']['from_date']) && isset($params['inputs']['to_date'])) {
            $query->whereBetween('inventory_invoice_details.date',[$params['inputs']['from_date'],$params['inputs']['to_date']]);
        }
        return $query->get();
    }
}

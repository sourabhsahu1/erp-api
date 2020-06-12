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
                $items = [
                    'store_id' => $data['data']['store_id'],
                    'item_id' => $item['item_id'],
                    'invoice_id' => $invoiceDetail->id,
                    'measurement_id' => $item['measurement_id'],
                    'description' => $item['description'],
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
                $items = [
                    'store_id' => $data['data']['store_id'],
                    'item_id' => $item['item_id'],
                    'invoice_id' => $invoiceDetail->id,
                    'measurement_id' => $item['measurement_id'],
                    'description' => $item['description'],
                    'unit_cost' => $item['unit_cost'],
                    'unit_price' => $item['unit_price'],
                    'quantity' => $item['quantity'],
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
                $items = [
                    'store_id' => $data['data']['store_id'],
                    'item_id' => $item['item_id'],
                    'invoice_id' => $invoiceDetail->id,
                    'measurement_id' => $item['measurement_id'],
                    'description' => $item['description'],
                    'unit_price' => $item['unit_price'],
                    'unit_cost' => $item['unit_cost'],
                    'quantity' => $item['quantity'],
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
                $items = [
                    'store_id' => $data['data']['store_id'],
                    'item_id' => $item['item_id'],
                    'invoice_id' => $invoiceDetail->id,
                    'measurement_id' => $item['measurement_id'],
                    'description' => $item['description'],
                    'selling_price' => $item['selling_price'],
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
                $items = [
                    'store_id' => $data['data']['store_id'],
                    'item_id' => $item['item_id'],
                    'invoice_id' => $invoiceDetail->id,
                    'description' => $item['description'],
                    'measurement_id' => $item['measurement_id'],
                    'account_code' => $item['account_code'],
                    'quantity' => $item['quantity'],
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
                $items = [
                    'store_id' => $data['data']['store_id'],
                    'item_id' => $item['item_id'],
                    'invoice_id' => $invoiceDetail->id,
                    'measurement_id' => $item['measurement_id'],
                    'description' => $item['description'],
                    'account_code' => $item['account_code'],
                    'quantity' => $item['quantity'],
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
                $items = [
                    'store_id' => $data['data']['store_id'],
                    'item_id' => $item['item_id'],
                    'invoice_id' => $invoiceDetail->id,
                    'measurement_id' => $item['measurement_id'],
                    'description' => $item['description'],
                    'unit_cost' => $item['unit_cost'],
                    'quantity' => $item['quantity'],
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
                $items = [
                    'store_id' => $data['data']['store_id'],
                    'item_id' => $item['item_id'],
                    'measurement_id' => $item['measurement_id'],
                    'invoice_id' => $invoiceDetail->id,
                    'description' => $item['description'],
                    'unit_cost' => $item['unit_cost'],
                    'quantity' => $item['quantity'],
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
                $items = [
                    'store_id' => $data['data']['store_id'],
                    'measurement_id' => $item['measurement_id'],
                    'item_id' => $item['item_id'],
                    'invoice_id' => $invoiceDetail->id,
                    'description' => $item['description'],
                    'account_code' => $item['account_code'],
                    'quantity' => $item['quantity'],
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
}

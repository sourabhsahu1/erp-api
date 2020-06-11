<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 10 Jun 2020 09:24:36 +0000.
 */

namespace Modules\Inventory\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class InventoryInvoiceDetail
 * 
 * @property int $id
 * @property int $company_id
 * @property int $department_id
 * @property int $store_id
 * @property int $total_items
 * @property \Carbon\Carbon $date
 * @property string $reference_number
 * @property string $po_number
 * @property string $source_doc_reference_number
 * @property string $memo
 * @property string $tax
 * @property string $company_type
 * @property string $type
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Modules\Admin\Models\Company $company
 * @property \Modules\Admin\Models\AdminSegment $admin_segment
 * @property \Modules\Inventory\Models\Store $store
 * @property \Illuminate\Database\Eloquent\Collection $invoice_items
 * @property \Illuminate\Database\Eloquent\Collection $invoice_taxes
 *
 * @package Modules\Inventory\Models
 */
class InvoiceDetail extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $table = "inventory_invoice_details";
	protected $casts = [
		'company_id' => 'int',
		'department_id' => 'int',
		'store_id' => 'int',
		'total_items' => 'int'
	];

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'company_id',
		'department_id',
		'store_id',
		'total_items',
		'date',
		'reference_number',
		'po_number',
		'source_doc_reference_number',
		'memo',
		'tax',
		'company_type',
		'type'
	];

	public function company()
	{
		return $this->belongsTo(\Modules\Admin\Models\Company::class, 'company_id');
	}

	public function admin_segment()
	{
		return $this->belongsTo(\Modules\Admin\Models\AdminSegment::class, 'department_id');
	}

	public function store()
	{
		return $this->belongsTo(\Modules\Inventory\Models\Store::class, 'store_id');
	}

	public function invoice_items()
	{
		return $this->hasMany(\Modules\Inventory\Models\InvoiceItem::class, 'invoice_id');
	}

	public function invoice_taxes()
	{
		return $this->hasMany(\Modules\Inventory\Models\InvoiceTax::class, 'invoice_id');
	}
}

<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 08 Jun 2020 11:28:00 +0000.
 */

namespace Modules\Admin\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Tax
 *
 * @property int $id
 * @property string $name
 * @property float $tax
 * @property bool $is_active
 * @property int $department_id
 * @property int $company_id
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \Modules\Admin\Models\Company $admin_company
 * @property \Modules\Admin\Models\AdminSegment $admin_segment
 *
 * @package Modules\Admin\Models
 */
class Tax extends Eloquent
{
    use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $table = 'admin_taxes';
    protected $casts = [
        'tax' => 'float',
        'is_active' => 'bool',
        'department_id' => 'int',
        'company_id' => 'int'
    ];

    protected $fillable = [
        'name',
        'tax',
        'is_active',
        'department_id',
        'company_id'
    ];

    public function company()
    {
        return $this->belongsTo(\Modules\Admin\Models\Company::class, 'company_id');
    }

    public function admin_segment()
    {
        return $this->belongsTo(\Modules\Admin\Models\AdminSegment::class, 'department_id');
    }


}

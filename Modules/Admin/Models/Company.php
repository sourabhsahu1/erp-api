<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 08 Jun 2020 11:26:23 +0000.
 */

namespace Modules\Admin\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Company
 *
 * @property int $id
 * @property string $name
 * @property bool $is_customer
 * @property bool $is_supplier
 * @property string $address
 * @property string $phone
 * @property string $email
 * @property string $tax_id
 * @property string $bank_account
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package Modules\Admin\Models
 */
class Company extends Eloquent
{
    use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $table = 'admin_companies';
    protected $casts = [
        'is_customer' => 'bool',
        'is_supplier' => 'bool'
    ];

    protected $fillable = [
        'name',
        'is_customer',
        'is_supplier',
        'address',
        'phone',
        'email',
        'tax_id',
        'bank_account'
    ];
}

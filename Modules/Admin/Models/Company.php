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
 * @property bool $is_active
 * @property bool $is_cashbook_ac
 * @property bool $is_on_off
 * @property bool $is_pf
 * @property string $address
 * @property string $phone
 * @property string $city
 * @property string $state
 * @property string $country
 * @property string $email
 * @property string $tax_id
 * @property string $bank_account
 * @property string $website
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \Illuminate\Database\Eloquent\Collection $company_banks
 * @package Modules\Admin\Models
 */
class Company extends Eloquent
{
    use \Illuminate\Database\Eloquent\SoftDeletes;


    protected $table = "admin_companies";
    protected $casts = [
        'is_customer' => 'bool',
        'is_supplier' => 'bool'
    ];

    public $filterable = [
        'id',
        'is_customer',
        'is_supplier'
    ];

    protected $fillable = [
        'name',
        'is_customer',
        'is_supplier',
        'is_active',
        'is_cashbook_ac',
        'is_on_off',
        'is_pf',
        'city',
        'state',
        'country',
        'address',
        'phone',
        'email',
        'website',
        'tax_id',
        'bank_account'
    ];

    public function company_banks()
    {
        return $this->hasMany(\Modules\Admin\Models\CompanyBank::class, 'company_id','id');
    }
}

<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 12 Nov 2020 11:27:15 +0000.
 */

namespace Modules\Treasury\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TreasuryCashbookType
 *
 * @property int $id
 * @property string $name
 * @property bool $is_active
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \Illuminate\Database\Eloquent\Collection $cashbooks
 *
 * @package Modules\Treasury\Models
 */
class CashbookType extends Eloquent
{
    use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $table = 'treasury_cashbook_types';
    protected $casts = [
        'is_active' => 'bool'
    ];

    protected $fillable = [
        'name',
        'is_active'
    ];

    public function cashbooks()
    {
        return $this->hasMany(\Modules\Treasury\Models\Cashbook::class, 'fund_owned_by');
    }
}

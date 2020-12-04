<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 10 Nov 2020 16:13:46 +0000.
 */

namespace Modules\Treasury\Models;

use Modules\Admin\Models\AdminSegment;
use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class DefaultSetting
 *
 * @property int $id
 * @property int $account_head_id
 * @property int $sub_organisation_id
 * @property int $admin_segment_id
 * @property int $fund_segment_id
 * @property int $economic_segment_id
 * @property int $program_segment_id
 * @property int $functional_segment_id
 * @property int $geo_code_segment_id
 * @property int $checking_officer_id
 * @property int $paying_officer_id
 * @property int $financial_controller_id
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \Modules\Hr\Models\Employee $hr_employee
 * @property \Modules\Admin\Models\AdminSegment $admin_segment
 * @property \Modules\Admin\Models\Company $admin_company
 *
 * @package Modules\Treasury\Models
 */
class DefaultSetting extends Eloquent
{
    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = 'treasury_default_settings';
    protected $casts = [
        'account_head_id' => 'int',
        'sub_organisation_id' => 'int',
        'admin_segment_id' => 'int',
        'fund_segment_id' => 'int',
        'economic_segment_id' => 'int',
        'program_segment_id' => 'int',
        'functional_segment_id' => 'int',
        'geo_code_segment_id' => 'int',
        'checking_officer_id' => 'int',
        'paying_officer_id' => 'int',
        'financial_controller_id' => 'int'
    ];

    protected $fillable = [
        'account_head_id',
        'sub_organisation_id',
        'admin_segment_id',
        'fund_segment_id',
        'economic_segment_id',
        'program_segment_id',
        'functional_segment_id',
        'geo_code_segment_id',
        'checking_officer_id',
        'paying_officer_id',
        'financial_controller_id'
    ];


    public function checking_officer()
    {
        return $this->belongsTo(\Modules\Hr\Models\Employee::class, 'checking_officer_id');
    }

    public function financial_controller()
    {
        return $this->belongsTo(\Modules\Hr\Models\Employee::class, 'financial_controller_id');
    }

    public function paying_officer()
    {
        return $this->belongsTo(\Modules\Hr\Models\Employee::class, 'paying_officer_id');
    }

    public function account_head()
    {
        return $this->belongsTo(\Modules\Admin\Models\AdminSegment::class, 'account_head_id');
    }

    public function program_segment()
    {
        return $this->belongsTo(\Modules\Admin\Models\AdminSegment::class, 'program_segment_id');
    }

    public function economic_segment()
    {
        return $this->belongsTo(\Modules\Admin\Models\AdminSegment::class, 'economic_segment_id');
    }

    public function functional_segment()
    {
        return $this->belongsTo(\Modules\Admin\Models\AdminSegment::class, 'functional_segment_id');
    }

    public function geo_code_segment()
    {
        return $this->belongsTo(\Modules\Admin\Models\AdminSegment::class, 'geo_code_segment_id');
    }

    public function admin_segment()
    {
        return $this->belongsTo(\Modules\Admin\Models\AdminSegment::class, 'admin_segment_id');
    }

    public function fund_segment()
    {
        return $this->belongsTo(\Modules\Admin\Models\AdminSegment::class, 'fund_segment_id');
    }

    public function sub_organisation()
    {
        return $this->belongsTo(\Modules\Admin\Models\AdminSegment::class, 'sub_organisation_id');
    }

    public function children()
    {
        return $this->getChilds()->with('children');
    }

    public function getChilds()
    {
        return $this->hasMany(AdminSegment::class, 'parent_id')->where('parent_id',1 );
    }
}

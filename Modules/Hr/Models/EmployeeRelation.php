<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 27 May 2020 15:19:45 +0000.
 */

namespace Modules\Hr\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class EmployeeRelation
 *
 * @property int $id
 * @property int $employee_id
 * @property int $relationship_id
 * @property int $relative_id
 * @property string $last_name
 * @property string $first_name
 * @property string $national_id
 * @property string $gender
 * @property \Carbon\Carbon $date_of_birth
 * @property bool $is_next_of_kin
 * @property int $country_id
 * @property int $region_id
 * @property int $state_id
 * @property int $lga_id
 * @property string $address_line_1
 * @property string $address_line_2
 * @property string $city
 * @property string $zip_code
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \Modules\Hr\Models\Country $country
 * @property \Modules\Hr\Models\Employee $employee
 * @property \Modules\Hr\Models\Lga $lga
 * @property \Modules\Hr\Models\Region $region
 * @property \Modules\Hr\Models\Relationship $relationship
 * @property \Modules\Hr\Models\State $state
 *
 * @package Modules\Hr\Models
 */
class EmployeeRelation extends Eloquent
{
    use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $table = 'hr_employee_relations';
    protected $casts = [
        'employee_id' => 'int',
        'relationship_id' => 'int',
        'relative_id' => 'int',
        'is_next_of_kin' => 'bool',
        'country_id' => 'int',
        'region_id' => 'int',
        'state_id' => 'int',
        'lga_id' => 'int'
    ];

    protected $dates = [
        'date_of_birth'
    ];

    protected $fillable = [
        'employee_id',
        'relationship_id',
        'relative_id',
        'last_name',
        'first_name',
        'national_id',
        'gender',
        'date_of_birth',
        'is_next_of_kin',
        'country_id',
        'region_id',
        'state_id',
        'lga_id',
        'address_line_1',
        'address_line_2',
        'city',
        'zip_code'
    ];

    public function country()
    {
        return $this->belongsTo(\Modules\Hr\Models\Country::class);
    }

    public function employee()
    {
        return $this->belongsTo(\Modules\Hr\Models\Employee::class, 'employee_id');
    }

    public function relative()
    {
        return $this->belongsTo(\Modules\Hr\Models\Employee::class, 'relative_id');
    }

    public function lga()
    {
        return $this->belongsTo(\Modules\Hr\Models\Lga::class);
    }

    public function region()
    {
        return $this->belongsTo(\Modules\Hr\Models\Region::class);
    }

    public function relationship()
    {
        return $this->belongsTo(\Modules\Hr\Models\Relationship::class, 'relationship_id');
    }

    public function state()
    {
        return $this->belongsTo(\Modules\Hr\Models\State::class);
    }

    public function relative_arm_services(){
        return $this->belongsTo(\Modules\Hr\Models\EmployeeMilitaryService::class,'relative_id');
    }
}

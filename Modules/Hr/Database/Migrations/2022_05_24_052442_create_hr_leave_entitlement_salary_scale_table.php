<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrLeaveEntitlementSalaryScaleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_leave_entitlement_salary_scale', function (Blueprint $table) {
            $table->unique(['salary_id', 'leave_type_id']);
            $table->bigIncrements('id');
            $table->bigInteger('salary_id');
            $table->bigInteger('leave_type_id');
            $table->bigInteger('due_days');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hr_leave_entitlement_salary_scale');
    }
}

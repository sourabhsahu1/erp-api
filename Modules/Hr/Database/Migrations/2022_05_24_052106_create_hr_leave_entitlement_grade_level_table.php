<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrLeaveEntitlementGradeLevelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_leave_entitlement_grade_level', function (Blueprint $table) {
            $table->unique(['grade_id', 'leave_type_id']);
            $table->bigIncrements('id');
            $table->bigInteger('grade_id');
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
        Schema::dropIfExists('hr_leave_entitlement_grade_level');
    }
}

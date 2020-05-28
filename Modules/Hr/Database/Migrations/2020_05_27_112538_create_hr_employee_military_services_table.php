<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrEmployeeMilitaryServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_employee_military_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('arm_of_service_id');
            $table->string('service_number');
            $table->string('last_unit');
            $table->date('engaged_at');
            $table->date('discharged_at');
            $table->string('reason_to_leave');
            $table->foreign('employee_id')->references('id')->on('hr_employees');
            $table->foreign('arm_of_service_id')->references('id')->on('hr_arm_of_services');
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
        Schema::dropIfExists('hr_employee_military_services');
    }
}

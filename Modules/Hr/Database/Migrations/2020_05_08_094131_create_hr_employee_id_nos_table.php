<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrEmployeeIdNosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_employee_id_nos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id');
            $table->string('nhf_number')->nullable();
            $table->string('tin_number')->nullable();
            $table->string('driver_license_number')->nullable();
            $table->string('bank_version_number')->nullable();
            //todo treasury module
            $table->string('pension_fund_administration')->nullable();
            //todo administration segment
            $table->string('company_name')->nullable();
            $table->string('pfa_number')->nullable();
            $table->foreign('employee_id')->references('id')->on('hr_employees');
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
        Schema::dropIfExists('hr_employee_id_nos');
    }
}

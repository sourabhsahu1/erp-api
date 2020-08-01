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
            $table->string('national_id_number')->nullable();
            $table->string('payroll_pin')->nullable();
            //todo treasury module
            $table->string('pension_fund_administration')->nullable();
            //todo administration segment
            $table->boolean('is_foreign_employee')->default(0);
            $table->unsignedBigInteger('pfa_number')->nullable();
            $table->foreign('pfa_number')->references('id')->on('admin_companies');
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

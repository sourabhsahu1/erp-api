<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrEmployeeBankDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_employee_bank_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('bank_id');
            $table->unsignedBigInteger('bank_branch_id');
            $table->string('country');
            $table->string('title');
            $table->string('number');
            $table->string('type');
            $table->foreign('employee_id')->references('id')->on('hr_employees');
            $table->foreign('bank_id')->references('id')->on('hr_banks');
            $table->foreign('bank_branch_id')->references('id')->on('hr_bank_branches');
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
        Schema::dropIfExists('hr_employee_bank_details');
    }
}

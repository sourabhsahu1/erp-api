<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrEmployeeCensuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_employee_censures', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('issued_by_id');
            $table->unsignedBigInteger('censure_id');
            $table->date('date_issued');
            //todo issuedby
            $table->unsignedBigInteger('file_id');
            $table->string('document_type');
            $table->string('file_page');
            $table->string('summary')->nullable();
            $table->foreign('file_id')->references('id')->on('files');
            $table->foreign('censure_id')->references('id')->on('hr_censures');
            $table->foreign('employee_id')->references('id')->on('hr_employees');
            $table->foreign('issued_by_id')->references('id')->on('hr_employees');
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
        Schema::dropIfExists('hr_employee_censures');
    }
}

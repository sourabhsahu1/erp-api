<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrEmployeeQualificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_employee_qualifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('qualification_id');
            $table->unsignedBigInteger('academic_id');
            $table->unsignedBigInteger('country_id');
            $table->string('institute_name');
            $table->foreign('employee_id')->references('id')->on('hr_employees');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('qualification_id')->references('id')->on('hr_qualifications');
            $table->foreign('academic_id')->references('id')->on('hr_academics');
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
        Schema::dropIfExists('hr_employee_qualifications');
    }
}

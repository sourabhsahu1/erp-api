<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrEmployeeSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_employee_schools', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('schedule_id');
            $table->unsignedBigInteger('country_id');
            $table->string('school');
            $table->string('address');
            $table->date('entered_at');
            $table->date('exited_at');
            $table->foreign('employee_id')->references('id')->on('hr_employees');
            $table->foreign('schedule_id')->references('id')->on('hr_schedules');
            $table->foreign('country_id')->references('id')->on('countries');
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
        Schema::dropIfExists('hr_employee_schools');
    }
}

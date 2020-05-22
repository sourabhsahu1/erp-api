<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrEmployeeJobProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_employee_job_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('job_position_id');
            $table->unsignedBigInteger('designation_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('work_location_id')->nullable();
            $table->unsignedBigInteger('salary_scale_id');
            $table->unsignedBigInteger('grade_level_id');
            $table->unsignedBigInteger('grade_level_step_id');
            $table->date('current_appointment')->nullable();
            $table->foreign('salary_scale_id')->references('id')->on('hr_salary_scales');
            $table->foreign('grade_level_id')->references('id')->on('hr_grade_levels');
            $table->foreign('grade_level_step_id')->references('id')->on('hr_grade_level_steps');
            $table->foreign('employee_id')->references('id')->on('hr_employees');
            $table->foreign('job_position_id')->references('id')->on('hr_job_positions');
            $table->foreign('work_location_id')->references('id')->on('hr_work_locations');
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
        Schema::dropIfExists('hr_employee_job_profiles');
    }
}

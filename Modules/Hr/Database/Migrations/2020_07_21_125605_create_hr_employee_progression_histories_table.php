<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrEmployeeProgressionHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_employee_progression_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('job_position_id');
            $table->unsignedBigInteger('designation_id');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('work_location_id');
            $table->unsignedBigInteger('salary_scale_id');
            $table->unsignedBigInteger('grade_level_id');
            $table->unsignedBigInteger('grade_level_step_id');
            $table->date('value_date')->nullable();
            $table->foreign('employee_id')->references('id')->on('hr_employees');
            $table->foreign('salary_scale_id')->references('id')->on('hr_salary_scales');
            $table->foreign('grade_level_id')->references('id')->on('hr_grade_levels');
            $table->foreign('grade_level_step_id')->references('id')->on('hr_grade_level_steps');
            $table->foreign('job_position_id')->references('id')->on('hr_job_positions');
            $table->foreign('work_location_id')->references('id')->on('hr_work_locations');
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('hr_employee_progression_histories');
    }
}

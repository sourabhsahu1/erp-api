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
            $table->unsignedInteger('department_id');
            $table->unsignedBigInteger('work_location_id');
            $table->unsignedBigInteger('salary_scale_id');
            $table->unsignedBigInteger('grade_level_id');
            $table->unsignedBigInteger('grade_level_step_id');
            $table->date('value_date')->nullable();
            $table->unsignedBigInteger('checked_by')->nullable();
            $table->unsignedBigInteger('authorised_by')->nullable();
            $table->unsignedBigInteger('prepared_by')->nullable();
            $table->date('checked_date')->nullable();
            $table->date('authorised_date')->nullable();
            $table->date('prepared_date')->nullable();


            $table->foreign('employee_id')->references('id')->on('hr_employees');
            $table->foreign('salary_scale_id')->references('id')->on('hr_salary_scales');
            $table->foreign('grade_level_id')->references('id')->on('hr_grade_levels');
            $table->foreign('grade_level_step_id')->references('id')->on('hr_grade_level_steps');
            $table->foreign('job_position_id')->references('id')->on('hr_job_positions');
            $table->foreign('work_location_id')->references('id')->on('hr_work_locations');
            $table->foreign('department_id')->references('id')->on('admin_segments');
            $table->foreign('designation_id')->references('id')->on('hr_designations');

            $table->foreign('checked_by')->references('id')->on('users');
            $table->foreign('authorised_by')->references('id')->on('users');
            $table->foreign('prepared_by')->references('id')->on('users');

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

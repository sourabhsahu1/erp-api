<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrJobPositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_job_positions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('name');
            $table->unsignedInteger('department_id');
            $table->unsignedBigInteger('designation_id');
            $table->unsignedBigInteger('salary_scale_id');
            $table->unsignedBigInteger('grade_level_id');
            $table->unsignedBigInteger('grade_level_step_id');
            $table->unsignedBigInteger('skill_id')->nullable();
            $table->string('cost_center')->nullable();
            $table->string('job_family')->nullable();
            $table->boolean('is_approved_position')->default(1);
            $table->boolean('is_active')->default(1);
            $table->boolean('is_child_enabled')->default(1);
            $table->string('activities')->nullable();
            $table->string('competences')->nullable();
            $table->string('job_description_summary')->nullable();
            $table->string('experience')->nullable();
            $table->string('education')->nullable();
            $table->foreign('skill_id')->references('id')->on('hr_skills');
            $table->foreign('parent_id')->references('id')->on('hr_job_positions');
            $table->foreign('department_id')->references('id')->on('admin_segments');
            $table->foreign('designation_id')->references('id')->on('hr_designations');
            $table->foreign('salary_scale_id')->references('id')->on('hr_salary_scales');
            $table->foreign('grade_level_id')->references('id')->on('hr_grade_levels');
            $table->foreign('grade_level_step_id')->references('id')->on('hr_grade_level_steps');
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
        Schema::dropIfExists('hr_job_positions');
    }
}

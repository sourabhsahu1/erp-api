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
            $table->unsignedBigInteger('organisation_structure_id');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('designation_id');
            $table->unsignedBigInteger('grade_level_step_id');
            $table->unsignedBigInteger('skill_id')->nullable();
            $table->string('cost_center')->nullable();
            $table->string('job_family')->nullable();
            $table->boolean('is_approved_position')->default(0);
            $table->boolean('is_active')->default(0);
            $table->string('activities')->nullable();
            $table->string('competences')->nullable();
            $table->string('job_description_summary')->nullable();
            $table->string('experience')->nullable();
            $table->string('education')->nullable();
            $table->foreign('skill_id')->references('id')->on('hr_skills');
            $table->foreign('organisation_structure_id')->references('id')->on('hr_organisation_structure');
            $table->foreign('department_id')->references('id')->on('hr_departments');
            $table->foreign('designation_id')->references('id')->on('hr_designations');
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

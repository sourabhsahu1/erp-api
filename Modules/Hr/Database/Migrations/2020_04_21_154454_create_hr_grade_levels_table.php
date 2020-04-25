<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrGradeLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_grade_levels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('salary_scale_id');
            $table->foreign('salary_scale_id')->references('id')->on('hr_salary_scales');
            $table->string('level');
            $table->unsignedInteger('increment_due')->comment('in months')->default(12);
            $table->unsignedInteger('promotion_due')->comment('in months')->default(24);
            $table->unsignedInteger('confirm_after')->comment('in months')->default(24);
            $table->unsignedInteger('retire_after')->comment('in years')->default(35);
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
        Schema::dropIfExists('hr_grade_levels');
    }
}

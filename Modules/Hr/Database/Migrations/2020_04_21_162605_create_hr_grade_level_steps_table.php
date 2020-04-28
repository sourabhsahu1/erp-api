<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrGradeLevelStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_grade_level_steps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('grade_level_id');
            $table->string('name');
            $table->foreign('grade_level_id')->references('id')->on('hr_grade_levels');
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
        Schema::dropIfExists('hr_grade_level_steps');
    }
}

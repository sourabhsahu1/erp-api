<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradeLevelStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grade_level_steps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('grade_level_id');
            $table->string('name');
            $table->foreign('grade_level_id')->references('id')->on('grade_levels');
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
        Schema::dropIfExists('grade_level_steps');
    }
}

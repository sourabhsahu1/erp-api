<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminSegmentLevelConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_segment_level_config', function (Blueprint $table) {
            $table->increments('id');
            $table->string('level');
            $table->smallInteger('count');
            $table->unsignedInteger('admin_segment_id')->nullable();
            $table->foreign('admin_segment_id')->references('id')->on('admin_segments');
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
        Schema::dropIfExists('admin_segment_level_config');
    }
}

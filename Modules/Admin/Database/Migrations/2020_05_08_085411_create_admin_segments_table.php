<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminSegmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_segments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('character_count');
            $table->smallInteger('max_level');
            $table->string('individual_code');
            $table->string('combined_code');
            $table->boolean('is_active');
            $table->unsignedInteger('top_level_id')->nullable();
            $table->smallInteger('top_level_child_count')->default(0);
            $table->unsignedInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('admin_segments');
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
        Schema::dropIfExists('admin_segments');
    }
}

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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('character_count');
            $table->number('max_level');
            $table->string('individual_code');
            $table->string('combined_code');
            $table->boolean('is_active');
            $table->number('parent_id');
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

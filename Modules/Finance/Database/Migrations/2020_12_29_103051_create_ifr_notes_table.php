<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIfrNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ifr_notes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->unsignedInteger('economic_segment_id')->nullable();
            $table->unsignedInteger('program_segment_id')->nullable();
            $table->foreign('economic_segment_id')->references('id')->on('admin_segments');
            $table->foreign('program_segment_id')->references('id')->on('admin_segments');
            $table->string('note_id');
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
        Schema::dropIfExists('ifr_notes');
    }
}

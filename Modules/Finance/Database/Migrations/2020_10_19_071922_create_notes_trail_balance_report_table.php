<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotesTrailBalanceReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes_trail_balance_report', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('economic_segment_id')->nullable();
            $table->foreign('economic_segment_id')->references('id')->on('admin_segments');
            $table->unsignedInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('admin_segments');

            $table->unsignedBigInteger('credit')->nullable();
            $table->unsignedBigInteger('debit')->nullable();
            $table->unsignedBigInteger('balance')->nullable();
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
        Schema::dropIfExists('notes_trail_balance_report');
    }
}

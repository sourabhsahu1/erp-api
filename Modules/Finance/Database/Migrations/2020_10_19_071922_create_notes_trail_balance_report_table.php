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
            $table->unsignedBigInteger('jv_tb_report_id')->nullable();
            $table->foreign('jv_tb_report_id')->references('id')->on('jv_trail_balance_report');
            $table->boolean('is_parent')->default(0);
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

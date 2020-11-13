<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTreasuryAiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treasury_aies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('aie_number');
            $table->date('date_issued');
            $table->string('narration');
            $table->unsignedInteger('fund_segment_id');
            $table->unsignedInteger('admin_segment_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('fund_segment_id')->references('id')->on('admin_segments');
            $table->foreign('admin_segment_id')->references('id')->on('admin_segments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('treasury_aies');
    }
}

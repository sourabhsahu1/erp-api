<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTreasuryAieEconomicBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treasury_aie_economic_balances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('aie_id');
            $table->unsignedInteger('economic_segment_id');
            $table->decimal('amount',14,2);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('aie_id')->references('id')->on('treasury_aies');
            $table->foreign('economic_segment_id')->references('id')->on('admin_segments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('treasury_aie_economic_balances');
    }
}

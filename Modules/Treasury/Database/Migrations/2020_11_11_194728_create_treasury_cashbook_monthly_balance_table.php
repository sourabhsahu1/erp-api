<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTreasuryCashbookMonthlyBalanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treasury_cashbook_monthly_balance', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cashbook_id');
            $table->unsignedInteger('month');
            $table->decimal('balance',18,2)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('cashbook_id')->references('id')->on('treasury_cashbooks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('treasury_cashbook_monthly_balance');
    }
}

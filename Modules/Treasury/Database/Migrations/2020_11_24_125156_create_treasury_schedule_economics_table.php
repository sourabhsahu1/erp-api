<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTreasuryScheduleEconomicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treasury_schedule_economics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('payee_voucher_id');
            $table->unsignedInteger('economic_segment_id');
            $table->decimal('amount',18,2);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('payee_voucher_id')->references('id')->on('treasury_payee_vouchers');
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
        Schema::dropIfExists('treasury_schedule_economics');
    }
}

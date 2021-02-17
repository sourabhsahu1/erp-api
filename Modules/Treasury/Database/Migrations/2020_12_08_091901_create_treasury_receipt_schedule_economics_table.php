<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTreasuryReceiptScheduleEconomicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treasury_receipt_schedule_economics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('receipt_payee_id');
            $table->unsignedBigInteger('receipt_voucher_id');
            $table->unsignedInteger('economic_segment_id');
            $table->decimal('amount',18,2);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('receipt_payee_id')->references('id')->on('treasury_receipt_payees');
            $table->foreign('receipt_voucher_id')->references('id')->on('treasury_receipt_vouchers');
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
        Schema::dropIfExists('treasury_receipt_schedule_economics');
    }
}

<?php

use App\Constants\AppConstant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiptVoucherLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipt_voucher_logs', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('receipt_voucher_id');
            $table->enum('previous_status',[
                AppConstant::RECEIPT_VOUCHER_STATUS_NEW,
                AppConstant::RECEIPT_VOUCHER_STATUS_CLOSED,
                AppConstant::RECEIPT_VOUCHER_STATUS_POSTED_TO_GL
            ])->nullable();
            $table->enum('current_status',[
                AppConstant::RECEIPT_VOUCHER_STATUS_NEW,
                AppConstant::RECEIPT_VOUCHER_STATUS_CLOSED,
                AppConstant::RECEIPT_VOUCHER_STATUS_POSTED_TO_GL
            ]);
            $table->date('date');
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('admin_id');
            $table->foreign('admin_id')->references('id')->on('users');
            $table->foreign('receipt_voucher_id')->references('id')->on('treasury_receipt_vouchers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receipt_voucher_logs');
    }
}

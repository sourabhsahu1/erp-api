<?php

use App\Constants\AppConstant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentVouchersLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_vouchers_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('payment_voucher_id');
            $table->unsignedBigInteger('admin_id');
            $table->enum('previous_status',[
                AppConstant::VOUCHER_STATUS_CHECKED,
                AppConstant::VOUCHER_STATUS_DRAFT,
                AppConstant::VOUCHER_STATUS_APPROVED,
                AppConstant::VOUCHER_STATUS_AUDITED,
                AppConstant::VOUCHER_STATUS_BUDGET_CONTROL_VERIFIED,
                AppConstant::VOUCHER_STATUS_CLOSED,
                AppConstant::VOUCHER_STATUS_NEW,
                AppConstant::VOUCHER_STATUS_ON_MANDATE,
                AppConstant::VOUCHER_STATUS_PAID,
                AppConstant::VOUCHER_STATUS_POSTED_TO_GL
            ]);
            $table->enum('current_status',[
                AppConstant::VOUCHER_STATUS_CHECKED,
                AppConstant::VOUCHER_STATUS_DRAFT,
                AppConstant::VOUCHER_STATUS_APPROVED,
                AppConstant::VOUCHER_STATUS_AUDITED,
                AppConstant::VOUCHER_STATUS_BUDGET_CONTROL_VERIFIED,
                AppConstant::VOUCHER_STATUS_CLOSED,
                AppConstant::VOUCHER_STATUS_NEW,
                AppConstant::VOUCHER_STATUS_ON_MANDATE,
                AppConstant::VOUCHER_STATUS_PAID,
                AppConstant::VOUCHER_STATUS_POSTED_TO_GL
            ]);
            $table->date('date');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('admin_id')->references('id')->on('users');
            $table->foreign('payment_voucher_id')->references('id')->on('treasury_payment_vouchers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_vouchers_logs');
    }
}

<?php

use App\Constants\AppConstant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRetireVoucherLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retire_voucher_logs', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('retire_voucher_id');
            $table->enum('previous_status',[
                AppConstant::RETIRE_VOUCHER_NEW,
                AppConstant::RETIRE_VOUCHER_APPROVED,
                AppConstant::RETIRE_VOUCHER_AUDITED,
                AppConstant::RETIRE_VOUCHER_CHECKED,
                AppConstant::RETIRE_VOUCHER_CLOSED,
                AppConstant::RETIRE_VOUCHER_RETIRE,
                AppConstant::RETIRE_VOUCHER_BUDGET_CODES_VERIFIED,
                AppConstant::RECEIPT_VOUCHER_STATUS_POSTED_TO_GL
            ])->nullable();
            $table->enum('current_status',[
                AppConstant::RETIRE_VOUCHER_NEW,
                AppConstant::RETIRE_VOUCHER_APPROVED,
                AppConstant::RETIRE_VOUCHER_AUDITED,
                AppConstant::RETIRE_VOUCHER_CHECKED,
                AppConstant::RETIRE_VOUCHER_CLOSED,
                AppConstant::RETIRE_VOUCHER_RETIRE,
                AppConstant::RETIRE_VOUCHER_BUDGET_CODES_VERIFIED,
                AppConstant::RECEIPT_VOUCHER_STATUS_POSTED_TO_GL
            ]);
            $table->date('date');
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('admin_id');
            $table->foreign('admin_id')->references('id')->on('users');
            $table->foreign('retire_voucher_id')->references('id')->on('treasury_retire_vouchers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('retire_voucher_logs');
    }
}

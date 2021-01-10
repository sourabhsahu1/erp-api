<?php

use App\Constants\AppConstant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTreasuryRetireVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treasury_retire_vouchers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('payment_voucher_id');
            $table->date('liability_value_date');
            $table->unsignedBigInteger('amount');
            $table->unsignedInteger('economic_segment_id')->nullable();
            $table->string('details');
            $table->enum('status',[
                AppConstant::RETIRE_VOUCHER_NEW,
                AppConstant::RETIRE_VOUCHER_APPROVED,
                AppConstant::RETIRE_VOUCHER_AUDITED,
                AppConstant::RETIRE_VOUCHER_CHECKED,
                AppConstant::RETIRE_VOUCHER_CLOSED,
                AppConstant::RETIRE_VOUCHER_RETIRE,
                AppConstant::RETIRE_VOUCHER_BUDGET_CODES_VERIFIED,
                AppConstant::RECEIPT_VOUCHER_STATUS_POSTED_TO_GL
            ]);
            $table->timestamps();
            $table->foreign('payment_voucher_id')->references('id')->on('treasury_payment_vouchers');
            $table->foreign('economic_segment_id')->references('id')->on('admin_segments');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('treasury_retire_vouchers');
    }
}

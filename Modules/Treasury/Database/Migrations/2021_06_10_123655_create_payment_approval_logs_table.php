<?php

use App\Constants\AppConstant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class   CreatePaymentApprovalLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_approval_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('payment_approval_id');
            $table->unsignedBigInteger('admin_id');
            $table->enum('previous_status',[
                AppConstant::PAYMENT_APPROVAL_NEW,
                AppConstant::PAYMENT_APPROVAL_CHECKED,
                AppConstant::PAYMENT_APPROVAL_APPROVED_AND_READY,
                AppConstant::PAYMENT_APPROVAL_FULLY_USED,
                AppConstant::PAYMENT_APPROVAL_READY_FOR_PV
            ]);
            $table->enum('current_status',[
                AppConstant::PAYMENT_APPROVAL_NEW,
                AppConstant::PAYMENT_APPROVAL_CHECKED,
                AppConstant::PAYMENT_APPROVAL_APPROVED_AND_READY,
                AppConstant::PAYMENT_APPROVAL_FULLY_USED,
                AppConstant::PAYMENT_APPROVAL_READY_FOR_PV
            ]);
            $table->date('date');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('admin_id')->references('id')->on('users');
            $table->foreign('payment_approval_id')->references('id')->on('treasury_payment_approvals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_approval_logs');
    }
}

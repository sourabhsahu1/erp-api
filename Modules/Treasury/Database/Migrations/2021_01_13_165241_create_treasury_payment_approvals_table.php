<?php

use App\Constants\AppConstant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTreasuryPaymentApprovalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treasury_payment_approvals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('admin_segment_id');
            $table->unsignedInteger('fund_segment_id');
            $table->unsignedInteger('economic_segment_id');
            $table->enum('employee_customer',[
                AppConstant::COMPANY_TYPE_CUSTOMER,
                AppConstant::PAYEE_EMPLOYEE
            ]);
            $table->unsignedBigInteger('prepared_by_id')->nullable();
            $table->unsignedBigInteger('authorised_by_id')->nullable();
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->date('value_date');
            $table->date('authorised_date')->nullable();
            $table->string('remark');
            $table->enum('status',[
                AppConstant::PAYMENT_APPROVAL_NEW,
                AppConstant::PAYMENT_APPROVAL_CHECKED,
                AppConstant::PAYMENT_APPROVAL_APPROVED_AND_READY,
                AppConstant::PAYMENT_APPROVAL_FULLY_USED,
                AppConstant::PAYMENT_APPROVAL_READY_FOR_PV
            ]);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('admin_segment_id')->references('id')->on('admin_segments');
            $table->foreign('fund_segment_id')->references('id')->on('admin_segments');
            $table->foreign('economic_segment_id')->references('id')->on('admin_segments');
            $table->foreign('prepared_by_id')->references('id')->on('hr_employees');
            $table->foreign('authorised_by_id')->references('id')->on('hr_employees');
            $table->foreign('currency_id')->references('id')->on('currencies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('treasury_payment_approvals');
    }
}

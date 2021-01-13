<?php

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
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->date('value_date');
            $table->date('authorised_date')->nullable();
            $table->string('remark');
            $table->unsignedBigInteger('amount');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('admin_segment_id')->references('id')->on('admin_segments');
            $table->foreign('fund_segment_id')->references('id')->on('admin_segments');
            $table->foreign('economic_segment_id')->references('id')->on('admin_segments');
            $table->foreign('employee_id')->references('id')->on('hr_employees');
            $table->foreign('company_id')->references('id')->on('admin_companies');
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

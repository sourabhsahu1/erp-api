<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentApprovalPayeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_approval_payees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('payment_approval_id');
            $table->year('year')->nullable();
            $table->string('details');
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->decimal('net_amount',18,2);
            $table->decimal('total_tax',18,2);
            $table->json('tax_ids')->nullable();
            $table->timestamps();
            $table->foreign('payment_approval_id')->references('id')->on('treasury_payment_approvals');
            $table->foreign('employee_id')->references('id')->on('hr_employees');
            $table->foreign('company_id')->references('id')->on('admin_companies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_approval_payees');
    }
}

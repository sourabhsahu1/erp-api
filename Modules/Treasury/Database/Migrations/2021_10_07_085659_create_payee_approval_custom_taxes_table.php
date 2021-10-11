<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayeeApprovalCustomTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payee_approval_custom_taxes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('payment_approval_payee_id');
            $table->unsignedBigInteger('tax_id');
            $table->unsignedDecimal('tax_percentage',12,2);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('tax_id')->references('id')->on('admin_taxes');
            $table->foreign('payment_approval_payee_id')->references('id')->on('payment_approval_payees');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payee_approval_custom_taxes');
    }
}

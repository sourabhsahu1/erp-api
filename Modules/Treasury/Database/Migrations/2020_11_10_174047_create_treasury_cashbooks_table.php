<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTreasuryCashbooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treasury_cashbooks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('economic_segment_id')->nullable();
            $table->string('cashbook_title');
            $table->decimal('bank_statement',18);
            $table->decimal('cashbook',18);
            $table->decimal('x_rate_local_currency',18);
            $table->unsignedInteger('payment_voucher_id')->nullable();
            $table->unsignedInteger('receipt_voucher_id')->nullable();
            $table->unsignedInteger('e_mandate')->nullable();
            $table->string('prefix')->nullable();
            $table->string('suffix')->nullable();
            $table->unsignedBigInteger('fund_owned_by')->nullable();
            $table->string('bank_account_number');
            $table->unsignedBigInteger('bank_id');
            $table->unsignedBigInteger('bank_branch_id');;
            $table->string('title');
            $table->unsignedBigInteger('currency_id');
            $table->string('type_of_account');
            $table->timestamps();
            $table->boolean('is_editable')->default(1);
            $table->softDeletes();
            $table->foreign('economic_segment_id')->references('id')->on('admin_segments');
            $table->foreign('fund_owned_by')->references('id')->on('treasury_cashbook_types');
            $table->foreign('bank_id')->references('id')->on('hr_banks');
            $table->foreign('bank_branch_id')->references('id')->on('hr_bank_branches');
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
        Schema::dropIfExists('treasury_cashbooks');
    }
}

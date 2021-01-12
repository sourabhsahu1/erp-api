<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTreasuryRetireLiabilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treasury_retire_liabilities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('liability_value_date');
            $table->unsignedBigInteger('amount');
            $table->unsignedInteger('economic_segment_id')->nullable();
            $table->unsignedBigInteger('retire_voucher_id');
            $table->string('details');
            $table->foreign('economic_segment_id')->references('id')->on('admin_segments');
            $table->foreign('retire_voucher_id')->references('id')->on('treasury_retire_vouchers');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('treasury_retire_liabilities');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryInvoiceTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_invoice_taxes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('invoice_id');
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('tax_id');
            $table->float('tax',4,2);
            $table->softDeletes();
            $table->foreign('invoice_id')->references('id')->on('inventory_invoice_details');
            $table->foreign('item_id')->references('id')->on('inventory_items');
            $table->foreign('tax_id')->references('id')->on('admin_taxes');
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
        Schema::dropIfExists('inventory_invoice_taxes');
    }
}

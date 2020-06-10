<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_invoice_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('store_id');
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('invoice_id');
            $table->unsignedBigInteger('measurement_id');
            $table->string('description')->nullable();
            $table->string('unit_price')->nullable();
            $table->string('unit_cost')->nullable();
            $table->string('quantity');
            $table->string('account_code')->nullable();
            $table->string('on_order')->nullable();
            $table->string('re_order_quantity')->nullable();
            $table->foreign('store_id')->references('id')->on('inventory_stores');
            $table->foreign('item_id')->references('id')->on('inventory_items');
            $table->foreign('invoice_id')->references('id')->on('inventory_invoice_details');
            $table->foreign('measurement_id')->references('id')->on('inventory_measurements');
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
        Schema::dropIfExists('inventory_invoice_items');
    }
}

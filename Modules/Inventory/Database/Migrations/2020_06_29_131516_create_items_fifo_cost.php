<?php

use App\Constants\AppConstant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsFifoCost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items_fifo_cost', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('type', [AppConstant::TYPE_IN, AppConstant::TYPE_OUT]);
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('invoice_id');
            $table->unsignedBigInteger('invoice_item_id');
            $table->integer('quantity');
            $table->double('unit_price', 8, 2);
            $table->double('price', 8, 2);
            $table->boolean('is_active')->default(1);
            $table->timestamps();

            $table->foreign('item_id')->references('id')->on('inventory_items');
            $table->foreign('invoice_item_id')->references('id')->on('inventory_invoice_items');
            $table->foreign('invoice_id')->references('id')->on('inventory_invoice_details');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items_fifo_cost');
    }
}

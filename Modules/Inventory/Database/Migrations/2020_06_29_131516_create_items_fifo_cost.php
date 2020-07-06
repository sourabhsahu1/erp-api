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
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('invoice_id');
            $table->integer('quantity')->nullable();
            $table->integer('available_quantity');
            $table->integer('price');
            $table->float('fifo_cost',8,2)->nullable();
            $table->float('selling_price',8,2)->nullable();
                $table->boolean('in_active')->default(1);
            $table->timestamps();
            $table->foreign('item_id')->references('id')->on('inventory_items');
            $table->enum('type',[AppConstant::TYPE_IN, AppConstant::TYPE_OUT]);
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

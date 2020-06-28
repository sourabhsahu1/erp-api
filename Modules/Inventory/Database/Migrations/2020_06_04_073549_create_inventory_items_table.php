<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('measurement_id')->nullable();
            $table->string('description');
            $table->string('part_number');
            $table->boolean('is_not_physical_quantity')->default(0);
            $table->boolean('is_charged_vat')->default(0);
            $table->boolean('is_charged_other_tax')->default(0);
            $table->integer('unit_price');
            $table->integer('sales_commission');
            $table->integer('lead_days');
            $table->integer('reorder_quantity');
            $table->integer('minimum_quantity');
            $table->integer('maximum_quantity');
            $table->softDeletes();


            $table->foreign('category_id')->references('id')->on('inventory_categories');
            $table->foreign('measurement_id')->references('id')->on('inventory_measurements');
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
        Schema::dropIfExists('inventory_items');
    }
}

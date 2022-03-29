<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FxaDepreciationDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fxa_depreciation_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('depreciation_id');
            $table->unsignedBigInteger('fxa_assets_id');
            $table->unsignedBigInteger('fxa_depr_method_id')->nullable();
//            $table->unsignedBigInteger('fxa_category_id')->nullable();
            $table->unsignedInteger('serial_number');
            $table->decimal('amount',18,2);
            $table->decimal('opening_balance',18,2);
            $table->decimal('closing_balance',18,2);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('fxa_depr_method_id')->references('id')->on('fxa_depreciation_methods');
//            $table->foreign('fxa_category_id')->references('id')->on('fxa_categories');
            $table->foreign('fxa_assets_id')->references('id')->on('fxa_assets');
            $table->foreign('depreciation_id')->references('id')->on('fxa_depreciations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fxa_depreciation_details');
    }
}

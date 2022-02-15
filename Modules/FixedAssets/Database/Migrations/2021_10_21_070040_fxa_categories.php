<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FxaCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fxa_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('title');
            $table->unsignedBigInteger('depreciation_method_id');
            $table->unsignedDecimal('depreciation_rate');
            $table->unsignedInteger('fixed_asset_acct_id')->nullable();
            $table->unsignedInteger('accum_depr_acct_id')->nullable();
            $table->unsignedInteger('depr_exps_acct_id')->nullable();
            $table->string('individual_code', '10')->nullable();
            $table->string('combined_code', '20')->nullable();
            $table->unsignedBigInteger('next_asset_no')->default(1);
            $table->unsignedBigInteger('ref_no_to_root_node')->nullable();
            $table->boolean('is_parent')->default(false);
            $table->boolean('is_editable')->default(0);
            $table->string('level_no')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('fixed_asset_acct_id')->references('id')->on('admin_segments');
            $table->foreign('accum_depr_acct_id')->references('id')->on('admin_segments');
            $table->foreign('depr_exps_acct_id')->references('id')->on('admin_segments');
            $table->foreign('parent_id')->references('id')->on('fxa_categories');
            $table->foreign('depreciation_method_id')->references('id')->on('fxa_depreciation_methods');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fxa_categories');
    }
}

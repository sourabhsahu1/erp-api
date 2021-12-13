<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('title');
            $table->unsignedInteger('fixed_asset_acct_id');
            $table->unsignedInteger('accum_depr_acct_id');
            $table->unsignedInteger('depr_exps_acct_id');
            $table->string('asset_no_prefix_line','10');
            $table->string('asset_no_prefix_full','20');
            $table->unsignedBigInteger('next_asset_no')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('ref_no_to_root_node')->nullable();
            $table->enum('is_parent',['Yes', 'No']);
            $table->boolean('is_editable')->default(0);
            $table->string('level_no');
            $table->softDeletes();

            $table->foreign('fixed_asset_acct_id')->references('id')->on('admin_segments');
            $table->foreign('accum_depr_acct_id')->references('id')->on('admin_segments');
            $table->foreign('depr_exps_acct_id')->references('id')->on('admin_segments');
            $table->foreign('parent_id')->references('id')->on('fxa_categories');
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
        Schema::dropIfExists('fxa_categories');
    }
}

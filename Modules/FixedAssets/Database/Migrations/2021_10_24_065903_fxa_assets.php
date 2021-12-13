<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FxaAssets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fxa_assets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('asset_no');
            $table->string('title');
            $table->unsignedInteger('custodian');
//            $table->foreign('custodian')->references('id')->on('employees');
            $table->string('make');
            $table->string('model');
            $table->string('model_no');
            $table->string('oem_serial_no');
            $table->string('oem_bar_code_no');
            $table->date('date_manufactured');
            $table->date('date_acquired');
            $table->unsignedInteger('acquisition_cost');
            $table->boolean('installed')->default(false);
            $table->date('commissioned');
            $table->date('decommissioned');
            $table->date('date_installed');
            $table->date('date_commissioned');
            $table->date('date_de_commissioned');
            $table->date('date_disposed');
            $table->unsignedInteger('disposal_price');
            $table->unsignedInteger('begin_accum_depr');
            $table->unsignedInteger('xptd_life_yrs');
            $table->unsignedInteger('salvage_value');
            $table->string('supplier_invoice');
            $table->string('supplier_name');
            $table->string('supplier_contact');
            $table->unsignedBigInteger('fxa_depr_method_id');
            $table->unsignedBigInteger('fxa_category_id');
            $table->unsignedBigInteger('fxa_status_id');
            $table->unsignedInteger('admin_segment_id');
            $table->unsignedInteger('economic_segment_id');
            $table->unsignedInteger('programme_segment_id');
            $table->unsignedInteger('fund_segment_id');
            $table->unsignedInteger('functional_segment_id');
            $table->unsignedInteger('geo_code_segment_id');
            $table->unsignedInteger('remark');
            $table->unsignedInteger('t_date');
            $table->unsignedInteger('login_id')->comment('hr_id');
            //nmrl_location check relation
            $table->unsignedInteger('nmrl_location');
            $table->unsignedInteger('qty');
            $table->unsignedInteger('file_id');
            $table->unsignedInteger('comments');
            $table->softDeletes();
            $table->foreign('fxa_depr_method_id')->references('id')->on('fxa_depr_methods');
            $table->foreign('fxa_category_id')->references('id')->on('fxa_categories');
            $table->foreign('fxa_status_id')->references('id')->on('fxa_statuses');
            $table->foreign('file_id')->references('id')->on('files');

            $table->foreign('admin_segment_id')->references('id')->on('admin_segments');
            $table->foreign('fund_segment_id')->references('id')->on('admin_segments');
            $table->foreign('economic_segment_id')->references('id')->on('admin_segments');
            $table->foreign('programme_segment_id')->references('id')->on('admin_segments');
            $table->foreign('functional_segment_id')->references('id')->on('admin_segments');
            $table->foreign('geo_code_segment_id')->references('id')->on('admin_segments');
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
        Schema::dropIfExists('fxa_assets');
    }
}

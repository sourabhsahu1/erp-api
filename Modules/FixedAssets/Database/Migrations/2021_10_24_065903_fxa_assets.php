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
            $table->string('asset_no')->nullable();
            $table->string('title')->nullable();
            $table->unsignedInteger('custodian')->nullable();
//            $table->foreign('custodian')->references('id')->on('employees');
            $table->string('make')->nullable();
            $table->string('model')->nullable();
            $table->string('model_no')->nullable();
            $table->string('oem_serial_no')->nullable();
            $table->string('oem_bar_code_no')->nullable();
            $table->date('date_manufactured')->nullable();
            $table->date('date_acquired')->nullable();
            $table->unsignedInteger('acquisition_cost')->nullable();
            $table->boolean('installed')->default(false);
            $table->date('commissioned')->nullable();
            $table->date('decommissioned')->nullable();
            $table->date('date_installed')->nullable();
            $table->date('date_commissioned')->nullable();
            $table->date('date_de_commissioned')->nullable();
            $table->date('date_disposed')->nullable();
            $table->unsignedInteger('disposal_price')->nullable();
            $table->unsignedInteger('begin_accum_depr')->nullable();
            $table->unsignedInteger('xptd_life_yrs')->nullable();
            $table->unsignedInteger('salvage_value')->nullable();
            $table->string('supplier_invoice')->nullable();
            $table->string('supplier_name')->nullable();
            $table->string('supplier_contact')->nullable();
            $table->unsignedBigInteger('fxa_depr_method_id')->nullable();
            $table->unsignedBigInteger('fxa_category_id')->nullable();
            $table->unsignedBigInteger('fxa_status_id')->nullable();
            $table->unsignedInteger('admin_segment_id')->nullable();
            $table->unsignedInteger('economic_segment_id')->nullable();
            $table->unsignedInteger('programme_segment_id')->nullable();
            $table->unsignedInteger('fund_segment_id')->nullable();
            $table->unsignedInteger('functional_segment_id')->nullable();
            $table->unsignedInteger('geo_code_segment_id')->nullable();
            $table->unsignedInteger('remark')->nullable();
            $table->unsignedInteger('t_date')->nullable();
            $table->unsignedInteger('login_id')->comment('hr_id')->nullable();
            //nmrl_location check relation
            $table->unsignedInteger('location_id')->nullable();
            $table->unsignedInteger('qty')->nullable();
            $table->unsignedBigInteger('file_id')->nullable();
            $table->unsignedInteger('comments')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('fxa_depr_method_id')->references('id')->on('fxa_deprecation_methods');
            $table->foreign('fxa_category_id')->references('id')->on('fxa_categories');
            $table->foreign('fxa_status_id')->references('id')->on('fxa_statuses');
            $table->foreign('file_id')->references('id')->on('files');
            $table->foreign('admin_segment_id')->references('id')->on('admin_segments');
            $table->foreign('fund_segment_id')->references('id')->on('admin_segments');
            $table->foreign('economic_segment_id')->references('id')->on('admin_segments');
            $table->foreign('programme_segment_id')->references('id')->on('admin_segments');
            $table->foreign('functional_segment_id')->references('id')->on('admin_segments');
            $table->foreign('geo_code_segment_id')->references('id')->on('admin_segments');
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

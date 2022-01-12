<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FxaDeployments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fxa_deployments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('fxa_assets_id');
            $table->unsignedBigInteger('custodian_id');
            $table->date('value_date');
            $table->unsignedInteger('admin_segment_id');
            $table->unsignedBigInteger('location_id');
            $table->string('remark')->nullable();
            $table->unsignedBigInteger('created_by_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('fxa_assets_id')->references('id')->on('fxa_assets');
            $table->foreign('admin_segment_id')->references('id')->on('admin_segments');
            $table->foreign('location_id')->references('id')->on('hr_work_locations');
            $table->foreign('custodian_id')->references('id')->on('users');
            $table->foreign('created_by_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fxa_deployments');
    }
}

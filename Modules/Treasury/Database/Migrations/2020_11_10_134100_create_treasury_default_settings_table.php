<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTreasuryDefaultSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treasury_default_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('account_head_id');
            //todo sub_organisation_id ?
            $table->unsignedInteger('sub_organisation_id');
            $table->unsignedInteger('admin_segment_id');
            $table->unsignedInteger('fund_segment_id');
            $table->unsignedInteger('economic_segment_id')->nullable();
            $table->unsignedInteger('program_segment_id')->nullable();
            $table->unsignedInteger('functional_segment_id')->nullable();
            $table->unsignedInteger('geo_code_segment_id')->nullable();

            $table->unsignedBigInteger('checking_officer_id')->nullable();
            $table->unsignedBigInteger('paying_officer_id')->nullable();
            $table->unsignedBigInteger('financial_controller_id')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('account_head_id')->references('id')->on('admin_segments');
            $table->foreign('sub_organisation_id')->references('id')->on('admin_segments');
            $table->foreign('admin_segment_id')->references('id')->on('admin_segments');
            $table->foreign('fund_segment_id')->references('id')->on('admin_segments');
            $table->foreign('economic_segment_id')->references('id')->on('admin_segments');
            $table->foreign('program_segment_id')->references('id')->on('admin_segments');
            $table->foreign('functional_segment_id')->references('id')->on('admin_segments');
            $table->foreign('geo_code_segment_id')->references('id')->on('admin_segments');
            $table->foreign('checking_officer_id')->references('id')->on('hr_employees');
            $table->foreign('paying_officer_id')->references('id')->on('hr_employees');
            $table->foreign('financial_controller_id')->references('id')->on('hr_employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('treasury_default_settings');
    }
}

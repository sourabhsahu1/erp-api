<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FxaInformations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fxa_informations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('deprecation_method_id')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('deprecation_method_id')->references('id')->on('fxa_depreciation_methods');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fxa_informations');
    }
}

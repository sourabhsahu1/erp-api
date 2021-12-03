<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisputeAppraisalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispute_appraisals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fileno');
            $table->string('emailaddress')->nullable();
            $table->string('dispute')->nullable();
            $table->boolean('isDisputable')->nullable();
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
        Schema::dropIfExists('dispute_appraisals');
    }
}

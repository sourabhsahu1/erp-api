<?php

use App\Constants\AppConstant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMandateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mandate_logs', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('mandate_id');
            $table->enum('previous_status',[
                AppConstant::ON_MANDATE_NEW,
                AppConstant::ON_MANDATE_1ST_AUTHORISED,
                AppConstant::ON_MANDATE_2ND_AUTHORISED,
                AppConstant::ON_MANDATE_POSTED_TO_GL
            ]);
            $table->enum('current_status',[
                AppConstant::ON_MANDATE_NEW,
                AppConstant::ON_MANDATE_1ST_AUTHORISED,
                AppConstant::ON_MANDATE_2ND_AUTHORISED,
                AppConstant::ON_MANDATE_POSTED_TO_GL
            ]);
            $table->date('date');
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('admin_id');
            $table->foreign('admin_id')->references('id')->on('users');
            $table->foreign('mandate_id')->references('id')->on('treasury_mandates');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mandate_logs');
    }
}

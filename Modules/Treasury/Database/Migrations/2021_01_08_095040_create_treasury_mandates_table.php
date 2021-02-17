<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Constants\AppConstant;
class CreateTreasuryMandatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treasury_mandates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cashbook_id');
            $table->unsignedInteger('batch_number')->nullable();
            $table->unsignedInteger('treasury_number')->nullable();
            $table->date('value_date');
            $table->string('instructions');
            $table->enum('status',[
                AppConstant::ON_MANDATE_NEW,
                AppConstant::ON_MANDATE_1ST_AUTHORISED,
                AppConstant::ON_MANDATE_2ND_AUTHORISED,
                AppConstant::ON_MANDATE_POSTED_TO_GL
            ]);
            $table->unsignedBigInteger('first_authorised_by')->nullable();
            $table->date('first_authorised_date')->nullable();
            $table->unsignedBigInteger('second_authorised_by')->nullable();
            $table->date('second_authorised_date')->nullable();
            $table->unsignedBigInteger('prepared_by');
            $table->date('prepared_date');
            $table->date('closed_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('first_authorised_by')->references('id')->on('hr_employees');
            $table->foreign('second_authorised_by')->references('id')->on('hr_employees');
            $table->foreign('prepared_by')->references('id')->on('hr_employees');
            $table->foreign('cashbook_id')->references('id')->on('treasury_cashbooks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('treasury_mandates');
    }
}

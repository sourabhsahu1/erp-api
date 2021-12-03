<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfirmAppraisalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('confirm_appraisals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('reportconfirmation')->nullable();
            $table->string('fileno')->nullable();
            $table->boolean('agreement')->nullable();
            $table->string('grading')->nullable();
            $table->date('serve')->nullable();
            $table->string('blockfullname')->nullable();
            $table->boolean('isAwardable')->nullable();
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
        Schema::dropIfExists('confirm_appraisals');
    }
}

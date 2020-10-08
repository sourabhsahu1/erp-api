<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetBreakupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budget_breakups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('budget_id');
            $table->unsignedInteger('month');
            $table->decimal('main_budget',18,2)->nullable();
            $table->decimal('supplementary_budget',18,2)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('budget_id')->references('id')->on('budget');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('budget_breakups');
    }
}

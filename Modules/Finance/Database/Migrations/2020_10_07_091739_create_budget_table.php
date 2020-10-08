<?php

use App\Constants\AppConstant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budget', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('admin_segment_id');
            $table->unsignedInteger('fund_segment_id');
            $table->unsignedInteger('economic_segment_id')->nullable();
            $table->unsignedInteger('program_segment_id')->nullable();
            $table->decimal('x_rate_local',12,2);
            $table->decimal('x_rate_to_international',12,2);
            $table->unsignedBigInteger('currency_id');
            $table->unsignedDecimal('budget_amount',16,2);
            $table->unsignedDecimal('previous_year_amount',16,2)->nullable();
            $table->unsignedDecimal('previous_year_actual_amount',16,2)->nullable();
            $table->unsignedDecimal('cumulative_previous_year_amount',16,2)->nullable();
            $table->unsignedDecimal('cumulative_previous_year_actual_amount',16,2)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('admin_segment_id')->references('id')->on('admin_segments');
            $table->foreign('fund_segment_id')->references('id')->on('admin_segments');
            $table->foreign('economic_segment_id')->references('id')->on('admin_segments');
            $table->foreign('program_segment_id')->references('id')->on('admin_segments');
            $table->foreign('currency_id')->references('id')->on('currencies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('budget');
    }
}

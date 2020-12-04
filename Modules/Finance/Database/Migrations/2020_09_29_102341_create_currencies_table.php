<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code_currency');
            $table->unsignedBigInteger('country_id');
            $table->string('singular_currency_name');
            $table->string('plural_currency_name');
            $table->string('currency_sign');
            $table->string('singular_change_name');
            $table->string('plural_change_name');
            $table->string('change_sign')->nullable();
            $table->decimal('month_1',12,2)->nullable();
            $table->decimal('month_2',12,2)->nullable();
            $table->decimal('month_3',12,2)->nullable();
            $table->decimal('month_4',12,2)->nullable();
            $table->decimal('month_5',12,2)->nullable();
            $table->decimal('month_6',12,2)->nullable();
            $table->decimal('month_7',12,2)->nullable();
            $table->decimal('month_8',12,2)->nullable();
            $table->decimal('month_9',12,2)->nullable();
            $table->decimal('month_10',12,2)->nullable();
            $table->decimal('month_11',12,2)->nullable();
            $table->decimal('month_12',12,2)->nullable();
            $table->decimal('previous_year_closing_rate_local',12,2)->nullable();
            $table->decimal('previous_year_closing_rate_international',12,2)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('country_id')->references('id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currencies');
    }
}

<?php

use App\Constants\AppConstant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJournalVoucherDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journal_voucher_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('journal_voucher_id');
            $table->string('currency');
            $table->decimal('x_rate_local',12,2);
            $table->decimal('bank_x_rate_to_usd',12,2);
            $table->string('account_name');
            $table->string('line_reference');
            $table->unsignedInteger('line_value');
            $table->unsignedInteger('admin_segment_id')->nullable();
            $table->foreign('admin_segment_id')->references('id')->on('admin_segments');
            $table->unsignedInteger('fund_segment_id')->nullable();
            $table->foreign('fund_segment_id')->references('id')->on('admin_segments');
            $table->unsignedInteger('economic_segment_id')->nullable();
            $table->foreign('economic_segment_id')->references('id')->on('admin_segments');
            $table->unsignedInteger('programme_segment_id')->nullable();
            $table->foreign('programme_segment_id')->references('id')->on('admin_segments');
            $table->unsignedInteger('functional_segment_id')->nullable();
            $table->foreign('functional_segment_id')->references('id')->on('admin_segments');
            $table->unsignedInteger('geo_code_segment_id')->nullable();
            $table->foreign('geo_code_segment_id')->references('id')->on('admin_segments');

            $table->enum('line_value_type',[
                AppConstant::LINE_VALUE_TYPE_CREDIT,
                AppConstant::LINE_VALUE_TYPE_DEBIT
            ]);
            $table->unsignedInteger('lv_line_value');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('journal_voucher_id')->references('id')->on('journal_vouchers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('journal_voucher_details');
    }
}

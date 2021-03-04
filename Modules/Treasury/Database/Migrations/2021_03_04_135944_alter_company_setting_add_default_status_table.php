<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCompanySettingAddDefaultStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_settings', function (Blueprint $table) {
            $table->enum('default_status', [
                \App\Constants\AppConstant::JV_STATUS_NEW,
                \App\Constants\AppConstant::JV_STATUS_CHECKED,
                \App\Constants\AppConstant::JV_STATUS_POSTED,
            ])->default(\App\Constants\AppConstant::JV_STATUS_POSTED);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_settings', function (Blueprint $table) {
            $table->dropForeign('treasury_payment_vouchers_payment_approve_id_foreign');
        });
    }
}

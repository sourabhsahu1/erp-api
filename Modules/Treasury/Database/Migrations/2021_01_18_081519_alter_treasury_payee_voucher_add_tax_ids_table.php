<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTreasuryPayeeVoucherAddTaxIdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('treasury_payee_vouchers', function (Blueprint $table) {
            $table->json('tax_ids')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('treasury_payee_vouchers', function (Blueprint $table) {
            $table->dropColumn('tax_ids');
        });
    }
}

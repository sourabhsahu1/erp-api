<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('address');
            $table->boolean('is_tax_enabled')->default(0);
            $table->boolean('is_customer')->default(0);
            $table->boolean('is_supplier')->default(0);
            $table->boolean('is_active')->default(1);
            $table->boolean('is_cashbook_ac')->default(0);
            $table->boolean('is_on_off')->default(0);
            $table->boolean('is_pfa')->default(0);
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('website');
//            $table->string('tax_id')->nullable();
//            $table->string('bank_account')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('admin_companies');
    }
}

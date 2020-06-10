<?php

use App\Constants\AppConstant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_invoice_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedInteger('department_id')->nullable();
            $table->unsignedBigInteger('store_id');
            $table->integer('total_items')->nullable();
            $table->date('date');
            $table->string('reference_number');
            $table->string('po_number')->nullable();
            $table->string('source_doc_reference_number');
            $table->string('memo')->nullable();
            $table->enum('company_type',[
                AppConstant::COMPANY_TYPE_CUSTOMER,
                AppConstant::COMPANY_TYPE_DEPARTMENT,
                AppConstant::COMPANY_TYPE_SUPPLIER
            ]);
            $table->enum('type',[
                AppConstant::TYPE_IN,
                AppConstant::TYPE_OUT
            ]);

            $table->foreign('company_id')->references('id')->on('admin_companies');
            $table->foreign('department_id')->references('id')->on('admin_segments');
            $table->foreign('store_id')->references('id')->on('inventory_stores');

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
        Schema::dropIfExists('inventory_invoice_details');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('insurance_id')->nullable();
            $table->date('invoice_date');
            $table->double('total')->default(0);
            $table->double('vat_percentage')->default(0);
            $table->double('total_vat')->default(0);
            $table->double('discount_percentage')->default(0);
            $table->double('total_discount')->default(0);
            $table->double('grand_total')->default(0);
            $table->double('paid')->default(0);
            $table->double('due')->default(0);
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
        Schema::dropIfExists('invoices');
    }
}

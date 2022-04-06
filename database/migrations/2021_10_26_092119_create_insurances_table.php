<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsurancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->string('name')->unique();
            $table->double('service_tax')->nullable()->default(0);
            $table->double('discount')->nullable()->default(0);
            $table->text('description')->nullable();
            $table->string('insurance_no')->nullable();
            $table->string('insurance_code')->nullable();
            $table->json('disease_charge')->nullable();
            $table->double('hospital_rate')->nullable()->default(0);
            $table->double('insurance_rate')->nullable()->default(0);
            $table->double('total')->nullable()->default(0);
            $table->enum('status', ['1','0'])->default('1');
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
        Schema::dropIfExists('insurances');
    }
}

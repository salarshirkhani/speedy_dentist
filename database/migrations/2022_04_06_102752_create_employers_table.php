<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employers', function (Blueprint $table) {
            $table->id();   
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('address')->nullable();
            $table->string('employer_id')->nullable();
            $table->string('max_limit')->nullable();
            $table->string('dep_limit')->nullable();
            $table->string('ortho')->nullable();
            $table->string('deductible')->nullable();
            $table->string('preventive')->nullable();
            $table->string('applies_to')->nullable();       
            $table->string('basic')->nullable();
            $table->string('crown')->nullable();
            $table->string('misc')->nullable();
            $table->unsignedBigInteger('insurance_id')->nullable();
            $table->string('group_plan')->nullable();
            $table->string('union_local')->nullable();
            $table->string('eligibility_phone')->nullable();
            $table->string('note')->nullable();
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
        Schema::dropIfExists('employers');
    }
}

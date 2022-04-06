<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EnhanceUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('age')->nullable();
            $table->string('birthdate')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('ssn')->nullable();
            $table->string('meidaid')->nullable();
            $table->string('prophy_recall')->nullable();
            $table->string('ins_payments')->nullable();
            $table->string('prim_usd')->nullable();
            $table->string('estimated_used')->nullable();
            $table->string('sex_used')->nullable();
            $table->string('tx_plan_used')->nullable();
            $table->string('has_guarantor')->nullable();
            $table->string('type')->nullable();
            $table->string('home_phone')->nullable();
            $table->string('balance')->nullable();
            $table->string('financial_alert')->nullable();
            $table->string('coverage_type')->nullable();
            $table->string('family_type')->nullable();
            $table->string('fee_schedule')->nullable();
            $table->string('primary_practioner')->nullable();
            $table->string('anclliary_practioner')->nullable();
            $table->string('next_recall')->nullable();
            $table->string('other_recall')->nullable();
            $table->string('recall_months')->nullable();
            $table->string('reason')->nullable();
            $table->string('reminder')->nullable();
     
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

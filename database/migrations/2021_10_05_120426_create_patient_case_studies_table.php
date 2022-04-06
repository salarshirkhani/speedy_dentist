<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientCaseStudiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_case_studies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('food_allergy')->nullable();
            $table->string('heart_disease')->nullable();
            $table->string('high_blood_pressure')->nullable();
            $table->string('diabetic')->nullable();
            $table->string('surgery')->nullable();
            $table->string('accident')->nullable();
            $table->string('others')->nullable();
            $table->string('family_medical_history')->nullable();
            $table->string('current_medication')->nullable();
            $table->string('pregnancy')->nullable();
            $table->string('breastfeeding')->nullable();
            $table->string('health_insurance')->nullable();
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
        Schema::dropIfExists('patient_case_studies');
    }
}

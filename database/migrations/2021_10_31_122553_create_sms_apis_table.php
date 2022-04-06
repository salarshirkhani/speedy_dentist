<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsApisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_apis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->enum('gateway', ['twilio','nexmo','plivo','clickatell']);
            $table->string('auth_id')->nullable();
            $table->string('auth_token')->nullable();
            $table->string('api_id')->nullable();
            $table->string('sender_number')->nullable();
            $table->enum('status', ['1','0'])->default('0');
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
        Schema::dropIfExists('sms_apis');
    }
}

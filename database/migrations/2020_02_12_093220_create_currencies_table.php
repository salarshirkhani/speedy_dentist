<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('company_id');
            $table->string('name');
            $table->string('code');
            $table->double('rate', 15, 8);
            $table->tinyInteger('enabled')->default(0);
            $table->string('precision')->nullable();
            $table->string('symbol')->nullable();
            $table->string('symbol_first')->nullable();
            $table->string('decimal_mark')->nullable();
            $table->string('thousands_separator')->nullable();
            $table->timestamps();
            $table->index('company_id');
            $table->unique(['company_id', 'code']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currencies');
    }
}

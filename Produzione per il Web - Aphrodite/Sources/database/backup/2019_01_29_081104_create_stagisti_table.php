<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStagistiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stagisti', function (Blueprint $table) {
            $table->string('codice_fiscale', 16)->primary();
            $table->integer('partita_iva')->nullable();
            $table->string('nome', 30);
            $table->string('cognome', 50);
            $table->integer('indirizzo_id')->unsigned();
            $table->boolean('sesso');
            $table->integer('luogo_nascita');
            $table->date('data_nascita');
        });

       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stagisti');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransazioniTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transazioni', function (Blueprint $table) {
            $table->string('numero_documento_fiscale')->primary();
            $table->string('tipo_documento_fiscale');
            $table->float('importo');
            $table->string('causale', 255);
            $table->date('data_erogazione');
            $table->string('modalita_pagamento');
            $table->boolean('in_entrata');
            $table->string('codice_fiscale_soggetto_transazione', 16)->nullable();
            $table->string('partita_iva_soggetto_transazione_id', 20)->nullable();
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
        Schema::dropIfExists('transazioni');
    }
}
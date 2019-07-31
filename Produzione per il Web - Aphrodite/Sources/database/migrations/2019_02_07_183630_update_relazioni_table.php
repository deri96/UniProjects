<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRelazioniTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->foreign('tessera_id')
                ->references('id')->on('tessere')
                ->onDelete('cascade');
        });

        Schema::table('tessere', function(Blueprint $table) {
            $table->foreign('indirizzo_id')
                ->references('id')->on('indirizzi')
                ->onDelete('cascade');
            $table->foreign('corso_acquistato')
                ->references('id')->on('corsi_acquistati')
                ->onDelete('cascade');
        });

        Schema::table('soci', function(Blueprint $table) {
            $table->foreign('tessera_id')
                ->references('id')->on('tessere')
                ->onDelete('cascade');
        });

        Schema::table('stagisti', function(Blueprint $table) {
            $table->foreign('indirizzo_id')
                ->references('id')->on('indirizzi')
                ->onDelete('cascade');
        });

        Schema::table('fornitori', function (Blueprint $table) {
            $table->foreign('indirizzo_id')
                ->references('id')->on('indirizzi')
                ->onDelete('cascade');
        });

        Schema::table('transazioni', function(Blueprint $table) {
            $table->foreign('partita_iva_soggetto_transazione_id')
                ->references('partita_iva')->on('fornitori')
                ->onDelete('cascade');
        });

        Schema::table('corsi', function(Blueprint $table) {
            $table->foreign('disciplina_id')
                ->references('id')->on('discipline')
                ->onDelete('cascade');
            $table->foreign('insegnante_id')
                ->references('codice_fiscale')->on('soci')
                ->onDelete('cascade');
            $table->foreign('stagista_id')
                ->references('codice_fiscale')->on('stagisti')
                ->onDelete('cascade');
        });

        Schema::table('pacchetti_corsi', function(Blueprint $table) {
            $table->foreign('corso_I')
                ->references('id')->on('corsi')
                ->onDelete('cascade');
            $table->foreign('corso_II')
                ->references('id')->on('corsi')
                ->onDelete('cascade');
            $table->foreign('corso_III')
                ->references('id')->on('corsi')
                ->onDelete('cascade');
        });

        Schema::table('corsi_acquistati', function(Blueprint $table) {
            $table->foreign('pacchetto_acquistato')
                ->references('id')->on('pacchetti_corsi')
                ->onDelete('cascade');
        });

        Schema::table('calendari', function (Blueprint $table) {
            $table->foreign('sala_id')
                ->references('id')->on('sale')
                ->onDelete('cascade');
            $table->foreign('corso_id')
                ->references('id')->on('corsi')
                ->onDelete('cascade');
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

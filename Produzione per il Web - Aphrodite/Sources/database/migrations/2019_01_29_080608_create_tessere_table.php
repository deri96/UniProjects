<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTessereTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tessere', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 30);
            $table->string('cognome', 50);
            $table->integer('indirizzo_id')->unsigned();
            $table->boolean('sesso');
            $table->string('luogo_nascita');
            $table->date('data_nascita');
            $table->date('data_iscrizione');
            $table->date('scadenza');
            $table->string('numero_telefono', 20);
            $table->string('numero_assicurazione', 20);
            $table->date('data_inizio_assicurazione');
            $table->date('data_fine_assicurazione');
            $table->date('data_inizio_certificato_medico');
            $table->date('data_fine_certificato_medico');
            $table->string('ruolo_societario');
            $table->string('ruolo_sportivo')->nullable();
            $table->string('note', 255)->nullable();
            $table->integer('corso_acquistato')->nullable()->unsigned();
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
        Schema::dropIfExists('tessere');
    }
}

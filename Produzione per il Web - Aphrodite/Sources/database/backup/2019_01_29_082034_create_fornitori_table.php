<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFornitoriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fornitori', function (Blueprint $table) {
            $table->integer('partita_iva')->primary()->unsigned();
            $table->string('nome', 50);
            $table->string('ragione_sociale');
            $table->integer('indirizzo_id');
            $table->string('tipo_fornitura');
            $table->integer('numero_di_telefono');
            $table->string('email', 100)->unique();
            $table->string('note', 100)->nullable();
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fornitori');
    }
}

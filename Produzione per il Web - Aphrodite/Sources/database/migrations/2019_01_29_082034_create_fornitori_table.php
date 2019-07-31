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
            $table->string('partita_iva', 20)->primary();
            $table->string('nome', 50);
            $table->string('ragione_sociale');
            $table->integer('indirizzo_id')->unsigned();
            $table->string('tipo_fornitura');
            $table->string('numero_telefono', 20);
            $table->string('email', 100)->unique();
            $table->string('note', 100)->nullable();
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
        Schema::dropIfExists('fornitori');
    }
}

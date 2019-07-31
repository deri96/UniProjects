<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSociTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soci', function (Blueprint $table) {
            $table->string('codice_fiscale', 16)->primary();
            $table->integer('tessera_id')->unsigned();
            $table->integer('utente_id')->unsigned()->nullable();
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
        Schema::dropIfExists('soci');
    }
}

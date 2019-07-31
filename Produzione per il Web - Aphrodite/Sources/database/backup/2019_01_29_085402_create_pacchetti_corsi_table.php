<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePacchettiCorsiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacchetti_corsi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 100);
            $table->integer('prezzo');
            $table->integer('corso_I')->unsigned();
            $table->integer('corso_II')->unsigned()->nullable();
            $table->integer('corso_III')->unsigned()->nullable();
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
        Schema::dropIfExists('pacchetti_corsi');
    }
}

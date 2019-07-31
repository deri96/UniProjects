<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorsiAcquistatiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corsi_acquistati', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pacchetto_acquistato')->unsigned();
            $table->date('data_inizio_corso');
            $table->date('data_fine_corso');
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
        Schema::dropIfExists('pacchetti_corsi_acquistati');
    }
}

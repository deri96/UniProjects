<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalendariTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendari', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('giorno_ora');
            $table->integer('sala_id')->unsigned();
            $table->integer('corso_id')->unsigned();
            $table->string('note', 191)->nullable();
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
        Schema::dropIfExists('calendari');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorsiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corsi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 100)->unique();
            $table->string('insegnante_id', 16)->nullable();
            $table->string('stagista_id', 16)->nullable();
            $table->integer('costo');
            $table->integer('disciplina_id')->unsigned();
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
        Schema::dropIfExists('corsi');
    }
}

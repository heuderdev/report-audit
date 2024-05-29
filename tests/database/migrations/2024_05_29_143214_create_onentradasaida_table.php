<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnentradasaidaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('onentradasaida', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('onvolume_id');
            $table->dateTime('entrada_robo', 3)->nullable();
            $table->dateTime('saida_robo', 3)->nullable();
            $table->timestamps();
            $table->string('was_created_in', 191)->nullable();
            
            $table->foreign('onvolume_id', 'onentradasaida_onvolume_id_fkey')->references('id')->on('onvolumes')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('onentradasaida');
    }
}

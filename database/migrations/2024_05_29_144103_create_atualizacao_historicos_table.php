<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtualizacaoHistoricosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atualizacao_historicos', function (Blueprint $table) {
            $table->integer('id')->index()->primary();
            $table->integer('historicos_id');
            $table->text('descricao')->nullable();
            $table->timestamps();
            $table->integer('usuario_id');
            $table->string('was_created_in', 191)->nullable();
            
            $table->foreign('usuario_id', 'atualizacao_historicos_usuario_id_fkey')->references('id')->on('usuarios')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('atualizacao_historicos');
    }
}

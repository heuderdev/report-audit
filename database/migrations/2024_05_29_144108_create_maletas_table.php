<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaletasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maletas', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('protocolo_id');
            $table->string('numero_maleta', 191)->unique('maletas_numero_maleta_key');
            $table->string('nome_usuario', 191)->nullable();
            $table->string('descricao', 191)->default('');
            $table->timestamps();
            $table->string('was_created_in', 191)->nullable();
            
            $table->index(['id', 'numero_maleta'], 'maletas_id_numero_maleta_idx');
            $table->foreign('protocolo_id', 'maletas_protocolo_id_fkey')->references('id')->on('protocolos')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maletas');
    }
}

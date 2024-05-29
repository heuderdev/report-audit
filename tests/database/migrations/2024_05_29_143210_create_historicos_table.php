<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoricosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historicos', function (Blueprint $table) {
            $table->integer('id')->index()->primary();
            $table->integer('maleta_id');
            $table->string('envio_custodia', 191)->nullable();
            $table->string('devolucao_sicoob', 191)->nullable();
            $table->string('numero_lacre', 191)->unique('historicos_numero_lacre_key');
            $table->timestamps();
            $table->string('was_created_in', 191)->nullable();
            
            $table->foreign('maleta_id', 'historicos_maleta_id_fkey')->references('id')->on('maletas')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historicos');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProtocolosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('protocolos', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('codigo_protocolo', 191)->unique('protocolos_codigo_protocolo_key');
            $table->timestamps();
            $table->string('was_created_in', 191)->nullable();
            
            $table->index(['id', 'codigo_protocolo'], 'protocolos_id_codigo_protocolo_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('protocolos');
    }
}

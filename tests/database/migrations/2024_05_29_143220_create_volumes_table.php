<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVolumesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('volumes', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('maleta_id');
            $table->integer('tipos_id');
            $table->string('codigo_volume', 191)->unique('volumes_codigo_volume_key');
            $table->string('local', 191)->default('off-site');
            $table->string('descricao', 191)->nullable();
            $table->boolean('esta_verificado')->default(0);
            $table->text('texto_verificado')->nullable();
            $table->timestamps();
            $table->string('was_created_in', 191)->nullable();
            
            $table->index(['id', 'codigo_volume'], 'volumes_id_codigo_volume_idx');
            $table->foreign('maleta_id', 'volumes_maleta_id_fkey')->references('id')->on('maletas')->onUpdate('cascade');
            $table->foreign('tipos_id', 'volumes_tipos_id_fkey')->references('id')->on('tipos')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('volumes');
    }
}

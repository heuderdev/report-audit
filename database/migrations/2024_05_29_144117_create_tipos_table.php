<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipos', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('nome', 191)->unique('tipos_nome_key');
            $table->timestamps();
            $table->string('was_created_in', 191)->nullable();
            
            $table->index(['id', 'nome'], 'tipos_id_nome_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipos');
    }
}

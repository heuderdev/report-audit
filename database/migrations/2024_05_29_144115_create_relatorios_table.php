<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelatoriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relatorios', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->text('path');
            $table->timestamps()->default('current_timestamp()');
            $table->string('particularity', 191)->nullable();
            $table->string('created_register', 191)->nullable();
            $table->integer('view')->default(0);
            $table->string('was_created_in', 191)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relatorios');
    }
}

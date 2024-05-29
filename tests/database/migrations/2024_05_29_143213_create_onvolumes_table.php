<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnvolumesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('onvolumes', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('numero_midia', 191)->unique('onvolumes_numero_midia_key');
            $table->string('username', 191)->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('onvolumes');
    }
}

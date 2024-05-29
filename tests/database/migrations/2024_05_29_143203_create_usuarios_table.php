<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('username')->unique('usuarios_username_key');
            $table->string('email', 191)->unique('usuarios_email_key');
            $table->string('password', 191);
            $table->integer('is_active')->default(1);
            $table->integer('is_admin')->default(0);
            $table->timestamps();
            $table->string('was_created_in', 191)->nullable();
            
            $table->index(['id', 'username', 'email'], 'usuarios_id_username_email_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}

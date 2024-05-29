<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrismaMigrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_prisma_migrations', function (Blueprint $table) {
            $table->string('id', 36)->primary();
            $table->string('checksum', 64);
            $table->dateTime('finished_at', 3)->nullable();
            $table->string('migration_name');
            $table->text('logs')->nullable();
            $table->dateTime('rolled_back_at', 3)->nullable();
            $table->dateTime('started_at', 3)->default('current_timestamp(3)');
            $table->unsignedInteger('applied_steps_count')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_prisma_migrations');
    }
}

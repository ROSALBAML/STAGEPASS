<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->text('descripcion')->nullable();
            $table->dateTime('fecha');
            $table->unsignedBigInteger('auditorio_id');
            $table->string('imagen')->nullable(); // Campo para imagen

            $table->unsignedBigInteger('organizador_id');
            $table->foreign('organizador_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('auditorio_id')->references('id')->on('auditorios')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};

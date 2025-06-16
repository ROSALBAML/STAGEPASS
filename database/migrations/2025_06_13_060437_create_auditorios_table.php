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
        Schema::create('auditorios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 60);
            $table->string('estado', 30);
            $table->string('ciudad', 60);
            $table->text('direccion');
            $table->integer('capacidad')->nullable();
            $table->text('comentarios')->nullable();
            $table->string('imagen')->nullable(); // Campo para imagen
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auditorios');
    }
};

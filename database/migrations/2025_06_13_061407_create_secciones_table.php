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
        Schema::create('secciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('auditorio_id');
            $table->string('nombre_seccion', 60);
            $table->decimal('precio', 10, 2);
            $table->text('observaciones')->nullable();
            $table->string('imagen')->nullable(); // Campo para imagen

            $table->foreign('auditorio_id')->references('id')->on('auditorios')->onDelete('NO ACTION');
            $table->unique(['auditorio_id', 'nombre_seccion'], 'uq_seccion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('secciones');
    }
};

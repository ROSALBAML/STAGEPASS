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
        Schema::create('promotores', function (Blueprint $table) {
            $table->id(); // ID propio de promotor (opcional si usas solo usuario_id como PK)
            $table->unsignedBigInteger('usuario_id')->unique(); // Relación 1 a 1 con usuarios
            $table->string('empresa', 100)->nullable(); // Por ejemplo, la empresa que representa el promotor
            $table->string('rfc', 13)->nullable();      // RFC de la empresa/promotor
            $table->string('pagina_web', 255)->nullable(); // Si aplica
            $table->timestamps(); // Para saber cuándo fue creado/modificado

            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotores');
    }
};

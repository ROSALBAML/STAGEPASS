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
        Schema::create('tarjeta_credito', function (Blueprint $table) {
            $table->id(); // id auto-incremental
            $table->unsignedBigInteger('usuario_id'); // FK hacia usuarios
            $table->string('numero_enmascarado', 20)->nullable();
            $table->string('token_seguro', 30)->nullable();
            $table->string('nombre_titular', 90)->nullable();
            $table->date('vencimiento')->nullable();

            // Llave foránea
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarjeta_credito');
    }
};

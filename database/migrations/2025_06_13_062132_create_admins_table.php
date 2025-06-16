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
        Schema::create('admins', function (Blueprint $table) {
            $table->unsignedBigInteger('usuario_id')->primary();
            $table->boolean('puede_crear_promotores')->default(true);
            $table->boolean('puede_crear_categorias')->default(true);
            $table->boolean('puede_crear_subcategorias')->default(true);
            $table->boolean('puede_cambiar_estado_evento')->default(true);

            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};

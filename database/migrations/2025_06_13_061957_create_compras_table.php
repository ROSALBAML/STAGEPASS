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
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('comprador_id');
            $table->unsignedBigInteger('tarjeta_credito_id')->nullable(); // Relación con tarjeta

            $table->dateTime('fecha_compra')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->decimal('total', 10, 2);

            $table->foreign('comprador_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('tarjeta_credito_id')->references('id')->on('tarjeta_credito')->onDelete('no action');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};

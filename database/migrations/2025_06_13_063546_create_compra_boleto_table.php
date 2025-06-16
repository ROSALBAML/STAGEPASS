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
        Schema::create('compra_boleto', function (Blueprint $table) {
            $table->unsignedBigInteger('compra_id');
            $table->unsignedBigInteger('boleto_id');
            $table->integer('cantidad');
                
            $table->primary(['compra_id', 'boleto_id']);
                
            $table->foreign('compra_id')->references('id')->on('compras')->onDelete('cascade');
            $table->foreign('boleto_id')->references('id')->on('boletos')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compra_boleto');
    }
};

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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // id (int, PK)
            $table->string('nombre', 30); // nombre (nvarchar(30), NOT NULL)
            $table->string('apellidos', 60); // apellidos (nvarchar(60), NOT NULL)
            $table->string('telefono', 15); // telefono (nvarchar(15), NOT NULL)
            $table->string('correo', 60)->unique(); // correo (nvarchar(60), NOT NULL)
            $table->string('contrasena_hash', 255); // contraseña_hash (nvarchar(255), NOT NULL)
            $table->dateTime('creado_en')->nullable(); // creado_en (datetime, NULLABLE)
            $table->boolean('activo')->nullable(); // activo (bit, NULLABLE)
            $table->unsignedBigInteger('rol_id');
            $table->foreign('rol_id')->references('id')->on('roles');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

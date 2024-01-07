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
        Schema::create('miembros', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_apellido');
            $table->string('cedula');
            $table->string('direccion');
            $table->string('telefono');
            $table->string('fecha_nacimiento');
            $table->string('genero');
            $table->string('email')->unique();
            $table->string('estado');
            $table->string('cargo');
            $table->text('foto');
            $table->string('fecha_ingreso');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('miembros');
    }
};

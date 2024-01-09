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
            $table->string('cedula')->unique();
            $table->string('fecha_nacimiento');
            $table->string('email')->unique();
            $table->string('telefono');
            $table->string('genero');
            $table->string('cargo');
            $table->string('direccion');
            $table->text('foto')->nullable();
            $table->string('estado');
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

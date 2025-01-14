<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorarioMateriaTable extends Migration {
    public function up() {
        Schema::create('horario_materia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('horario_id')->constrained('horarios')->onDelete('cascade');  // Relación con Horarios
            $table->foreignId('materia_id')->constrained('materias')->onDelete('cascade');
            $table->foreignId('profesor_id')->nullable()->constrained('miembros')->onDelete('cascade');  // Relación con Materias
            $table->string('dia')->nullable();  // Día de la semana (Lunes, Martes, etc.)
            $table->string('hora')->nullable();  // Rango de horas (8:00 – 8:45)
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('horario_materia');
    }
}
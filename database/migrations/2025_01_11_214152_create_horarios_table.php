<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorariosTable extends Migration {
    public function up() {
        Schema::create('horarios', function (Blueprint $table) {
            $table->id();  // Auto incremento para el id del horario
            $table->foreignId('pnf_id')->constrained('pnfs')->onDelete('cascade');  // Relación con PNF
            $table->string('trayecto');  // Trayecto del PNF
            $table->string('semestre');  // Semestre
            $table->string('turno');  // Turno (Mañana, Tarde, etc.)
            $table->string('seccion');
            $table->string('dia')->nullable();  // Día de la semana (Lunes, Martes, etc.)
            $table->string('hora')->nullable();  // Rango de horas (8:00 – 8:45)
            $table->foreignId('materia_id')->constrained('materias')->onDelete('cascade');  // Relación con Materias
            $table->foreignId('profesor_id')->constrained('miembros')->onDelete('cascade');  // Relación con Miembro (profesor)
            $table->timestamps();  // Timestamps (created_at, updated_at)
        });
    }

    public function down() {
        Schema::dropIfExists('horarios');
    }
}

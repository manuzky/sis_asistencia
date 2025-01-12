<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorarioMateriaTable extends Migration
{
    public function up()
    {
        Schema::create('horario_materia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('horario_id')->constrained('horarios')->onDelete('cascade');  // Relación con Horarios
            $table->foreignId('materia_id')->constrained('materias')->onDelete('cascade');  // Relación con Materias
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('horario_materia');
    }
}
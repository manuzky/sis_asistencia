<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_materias_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriasTable extends Migration
{
    public function up()
    {
        Schema::create('materias', function (Blueprint $table) {
            $table->id();  // ID autoincrementable
            $table->string('nombre');  // Nombre de la materia
            $table->foreignId('pnf_id')->constrained('pnfs')->onDelete('cascade');  // Relación con la tabla 'pnfs'
            $table->timestamps();  // Tiempos de creación y actualización
        });
    }

    public function down()
    {
        Schema::dropIfExists('materias');  // Eliminar la tabla si hace rollback
    }
}

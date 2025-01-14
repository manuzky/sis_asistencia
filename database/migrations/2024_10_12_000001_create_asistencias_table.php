<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asistencias', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->time('hora_entrada')->nullable();
            $table->time('hora_salida')->nullable();
            $table->bigInteger('miembro_id')->unsigned();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('cargo_id')->unsigned()->nullable(); // Agregamos la columna cargo_id
            $table->timestamps();
    
            $table->foreign('miembro_id')->references('id')->on('miembros')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('cargo_id')->references('id')->on('cargos')->onDelete('set null'); // Relación con la tabla cargos
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });
    }    

    public function down(): void
    {
        Schema::dropIfExists('asistencias');
    }
};

<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_pnfs_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePnfsTable extends Migration
{
    public function up()
    {
        Schema::create('pnfs', function (Blueprint $table) {
            $table->id();  // ID autoincrementable
            $table->string('nombre');  // Campo para el nombre del PNF
            $table->timestamps();  // Tiempos de creación y actualización
        });
    }

    public function down()
    {
        Schema::dropIfExists('pnfs');  // Eliminar la tabla si hace rollback
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cargo;

class CargoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cargo::create( [
            'nombre_cargo' => 'Desarrollador',
            'descripcion_cargo' => 'Desarrollador y/o colaboradores del sistema web.',
        ]);
        Cargo::create( [
            'nombre_cargo' => 'Docente',
            'descripcion_cargo' => 'Profesores de la universidad.',
        ]);
        Cargo::create( [
            'nombre_cargo' => 'Obrero',
            'descripcion_cargo' => 'Personal de mantenimiento y obrero.',
        ]);
        Cargo::create( [
            'nombre_cargo' => 'Administrativo',
            'descripcion_cargo' => 'Personal de administración.',
        ]);
        Cargo::create( [
            'nombre_cargo' => 'Directivo',
            'descripcion_cargo' => 'Personal de directivo de la universidad.',
        ]);
    }
}

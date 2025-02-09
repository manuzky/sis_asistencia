<?php

namespace Database\Seeders;

use App\Models\Miembro;
use App\Models\Cargo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MiembroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtén los cargos específicos
        $cargoDocente = Cargo::where('nombre_cargo', 'Docente')->first();
        $cargoDesarrollador = Cargo::where('nombre_cargo', 'Desarrollador')->first();
        $cargoObrero = Cargo::where('nombre_cargo', 'Obrero')->first();

        Miembro::create([
            'nombre_apellido' => 'José Carrasquel',
            'cedula' => '30205553',
            'direccion' => 'Por ahí en la calle',
            'telefono' => '04248534449',
            'fecha_nacimiento' => '2000-10-17',
            'genero' => 'MASCULINO',
            'email' => 'manuelc.dev@gmail.com',
            'estado' => '1',
            'cargo_id' => $cargoDocente->id,
            'foto' => '',
            'fecha_ingreso' => '2024-01-04',
        ]);

        Miembro::create([
            'nombre_apellido' => 'Diego Albino',
            'cedula' => '30141723',
            'direccion' => 'Creo que Rivera Guaica',
            'telefono' => '04248172330',
            'fecha_nacimiento' => '2003-06-06',
            'genero' => 'MASCULINO',
            'email' => 'diegoalbino0606@gmail.com',
            'estado' => '1',
            'cargo_id' => $cargoDocente->id,
            'foto' => '',
            'fecha_ingreso' => '2024-01-04',
        ]);

        Miembro::create([
            'nombre_apellido' => 'Cesar Guarema',
            'cedula' => '30131633',
            'direccion' => 'Allá en la fuente había un chorrito',
            'telefono' => '04248716974',
            'fecha_nacimiento' => '2002-11-16',
            'genero' => 'MASCULINO',
            'email' => 'guaremacacerescesaraugusto@gmail.com',
            'estado' => '1',
            'cargo_id' => $cargoDocente->id,
            'foto' => '',
            'fecha_ingreso' => '2024-01-04',
        ]);

        // Miembro con cargo Mantenimiento
        Miembro::create([
            'nombre_apellido' => 'Carlos Liendo',
            'cedula' => '30935601',
            'direccion' => 'Se hacía grandote, se hacía chiquito',
            'telefono' => '04121886508',
            'fecha_nacimiento' => '2003-09-27',
            'genero' => 'MASCULINO',
            'email' => 'eduardo.liendo27@gmail.com',
            'estado' => '1',
            'cargo_id' => $cargoObrero->id,
            'foto' => '',
            'fecha_ingreso' => '2024-01-04',
        ]);

        Miembro::factory(64)->create();
    }
}

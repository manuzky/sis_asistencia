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
        $cargoDesarrollador = Cargo::where('nombre_cargo', 'Desarrollador')->first();

        Miembro::create([
            'nombre_apellido' => 'José Carrasquel',
            'cedula' => '30205553',
            'direccion' => 'Por ahí en la calle',
            'telefono' => '04248534449',
            'fecha_nacimiento' => '2000-10-17',
            'genero' => 'MASCULINO',
            'email' => 'manuelc.dev@gmail.com',
            'estado' => '1',
            'cargo_id' => $cargoDesarrollador->id,
            'foto' => '',
            'fecha_ingreso' => '2024-01-04',
        ]);

        // Miembro::factory(64)->create();
    }
}

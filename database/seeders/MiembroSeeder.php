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
        $cargo = Cargo::inRandomOrder()->first();
        Miembro::create([
            'nombre_apellido' => 'José Carrasquel',
            'cedula' => '30205553',
            'direccion' => 'Barcelona, Guamachito, Calle Libertad, Vereda Libertad, casa S/N.',
            'telefono' => '04248534449',
            'fecha_nacimiento' => '2000-10-17',
            'genero' => 'MASCULINO',
            'email' => 'josem.zky@gmail.com',
            'estado' => '1',
            'cargo_id' => $cargo->id,
            'foto' => 'foto_miembro/joseC.jpg',
            'fecha_ingreso' => '2024-01-04',
        ]);
        
    }
}

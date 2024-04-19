<?php

namespace Database\Seeders;

use App\Models\Miembro;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MiembroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Miembro::create([
            'nombre_apellido' => 'José Carrasquel',
            'cedula' => '30205553',
            'direccion' => 'Barcelona, Guamachito, Calle Libertad, Vereda Libertad, casa S/N.',
            'telefono' => '04248534449',
            'fecha_nacimiento' => '2000-10-17',
            'genero' => 'MASCULINO',
            'email' => 'josem.zky@gmail.com',
            'estado' => '1',
            'cargo' => 'Desarrollador',
            'foto' => 'foto_miembro/joseC.jpg',
            'fecha_ingreso' => '2024-01-04',
        ]);
        Miembro::create([
            'nombre_apellido' => 'Diego Albino',
            'cedula' => '30141723',
            'direccion' => 'Fundación Mendoza, Av. Raúl Leoni, Conjunto Residencial Alto Guaica.',
            'telefono' => '04248172330',
            'fecha_nacimiento' => '2003-06-06',
            'genero' => 'MASCULINO',
            'email' => 'diegoalbino0606@gmail.com',
            'estado' => '1',
            'cargo' => 'Desarrollador',
            'foto' => '',
            'fecha_ingreso' => '2024-01-04',
        ]);
        Miembro::create([
            'nombre_apellido' => 'Cesar Guarema',
            'cedula' => '30131633',
            'direccion' => 'Urb.Brisas del Mar, calle 4 casa NRO 23',
            'telefono' => '04248716974',
            'fecha_nacimiento' => '2002-11-16',
            'genero' => 'MASCULINO',
            'email' => 'guaremacacerescesaraugusto@gmail.com',
            'estado' => '1',
            'cargo' => 'Desarrollador',
            'foto' => '',
            'fecha_ingreso' => '2024-01-04',
        ]);
        Miembro::create([
            'nombre_apellido' => 'Carlos Liendo',
            'cedula' => '30935601',
            'direccion' => 'Av fraternidad, Conjunto Residencial Venus',
            'telefono' => '04121886508',
            'fecha_nacimiento' => '2003-09-27',
            'genero' => 'MASCULINO',
            'email' => 'eduardo.liendo27@gmail.com',
            'estado' => '1',
            'cargo' => 'Desarrollador',
            'foto' => '',
            'fecha_ingreso' => '2024-01-04',
        ]);
    }
}

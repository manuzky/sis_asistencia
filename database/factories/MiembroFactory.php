<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Miembro;
use App\Models\Cargo;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Miembro>
 */
class MiembroFactory extends Factory
{
    public function definition(): array
    {
        $prefijosTelefono = ['0424', '0414', '0426', '0416', '0412'];
        $cargos = ['Desarrollador', 'Docente', 'Obrero', 'Administrativo'];
        $generos = ['Masculino', 'Femenino'];

        // Excluir el cargo "Desarrollador"
        $cargosDisponibles = Cargo::where('nombre_cargo', '!=', 'Desarrollador')->get();

        return [
            'nombre_apellido' => fake()->name(),
            'cedula' => random_int(5000000, 45000000),
            'direccion' => fake()->address(),
            'telefono' => fake()->randomElement($prefijosTelefono) . fake()->numerify('#######'),
            'fecha_nacimiento' => fake()->date($format = 'Y-m-d', $max = 'now'),
            'genero' => fake()->randomElement($generos),
            'email' => fake()->unique()->safeEmail(),
            'estado' => '1',
            'cargo_id' => $cargosDisponibles->random()->id, // Seleccionamos un cargo aleatorio pero excluyendo "Desarrollador"
            'foto' => '',
            'fecha_ingreso' => fake()->date($format = 'Y-m-d', $max = 'now'),
        ];
    }
}

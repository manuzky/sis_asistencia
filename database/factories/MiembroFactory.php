<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Miembro;
use App\Models\Cargo;
use Illuminate\Support\Str;

class MiembroFactory extends Factory
{
    public function definition(): array
    {
        $prefijosTelefono = ['0424', '0414', '0426', '0416', '0412'];
        $cargos = ['Desarrollador', 'Docente', 'Obrero', 'Administrativo'];
        $generos = ['MASCULINO', 'FEMENINO'];

        // Excluir el cargo "Desarrollador"
        $cargosDisponibles = Cargo::where('nombre_cargo', '!=', 'Desarrollador')->get();

        // Definir listas de nombres masculinos y femeninos
        $nombresMasculinos = [
            'Juan', 'Carlos', 'Pedro', 'Miguel', 'Luis', 'Jorge', 'Francisco', 'Manuel', 'Antonio', 'David',
            'José', 'Alejandro', 'Daniel', 'Santiago', 'Ricardo', 'Eduardo', 'Raúl', 'Tomás', 'Felipe', 'Andrés',
            'Álvaro', 'Víctor', 'Fernando', 'Marco', 'Gabriel', 'Luis Miguel', 'Héctor', 'Emilio', 'Iván', 'Pablo',
            'Juan Carlos', 'Marcelo', 'Carlos Alberto', 'Oscar', 'Ramón', 'Gustavo', 'Rubén', 'Esteban', 'Luis Alberto',
            'Ariel', 'Héctor Gabriel'
        ];

        $nombresFemeninos = [
            'Maria', 'Ana', 'Laura', 'Carmen', 'Sofía', 'Isabel', 'Pilar', 'Lucía', 'Marta', 'Elena',
            'Patricia', 'Teresa', 'Raquel', 'Carla', 'Paula', 'Sara', 'Beatriz', 'María José', 'Nuria', 'Victoria',
            'Julia', 'Sandra', 'Adriana', 'Alba', 'Monica', 'Antonia', 'Ángela', 'Cristina', 'Verónica', 'Rosa',
            'Begoña', 'Dolores', 'Margarita', 'Celia', 'Mercedes', 'Esther', 'Lola', 'Carolina', 'Alicia', 'Miriam',
            'Marina', 'Yolanda'
        ];

        // Seleccionar un género aleatorio
        $genero = fake()->randomElement($generos);

        // Generar nombre basado en el género
        if ($genero === 'MASCULINO') {
            $nombre = fake()->randomElement($nombresMasculinos);
        } else {
            $nombre = fake()->randomElement($nombresFemeninos);
        }

        return [
            'nombre_apellido' => $nombre . ' ' . fake()->lastName(),
            'cedula' => random_int(5000000, 45000000),
            'direccion' => fake()->address(),
            'telefono' => fake()->randomElement($prefijosTelefono) . fake()->numerify('#######'),
            'fecha_nacimiento' => fake()->date($format = 'Y-m-d', $max = 'now'),
            'genero' => $genero, // Asignamos el género seleccionado
            'email' => fake()->unique()->safeEmail(),
            'estado' => '1',
            'cargo_id' => $cargosDisponibles->random()->id, // Seleccionamos un cargo aleatorio pero excluyendo "Desarrollador"
            'foto' => '',
            'fecha_ingreso' => fake()->date($format = 'Y-m-d', $max = 'now'),
        ];
    }
}

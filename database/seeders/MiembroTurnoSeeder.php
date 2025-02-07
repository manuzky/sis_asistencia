<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Miembro;
use App\Models\Turno;
use Illuminate\Support\Facades\DB;

class MiembroTurnoSeeder extends Seeder
{
    public function run()
    {
        // Obtener todos los miembros y turnos
        $miembros = Miembro::all();
        $turnos = Turno::all();

        // Recorrer cada miembro y asignar turnos aleatorios
        foreach ($miembros as $miembro) {
            // Elegir aleatoriamente entre 1, 2 o 3 turnos
            $randomTurnos = $turnos->random(rand(1, 3)); // rand(1, 3) genera entre 1 y 3 turnos

            // Asignar los turnos al miembro
            $miembro->turnos()->sync($randomTurnos);  // Sincroniza los turnos seleccionados con el miembro
        }
    }
}

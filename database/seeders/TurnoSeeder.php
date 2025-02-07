<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TurnoSeeder extends Seeder {
    public function run(): void {
        DB::table('turnos')->insert([
            ['nombre' => 'Mañana'],
            ['nombre' => 'Tarde'],
            ['nombre' => 'Noche'],
        ]);
    }
}

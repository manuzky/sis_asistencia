<?php

// app/Http/Controllers/MateriaController.php

namespace App\Http\Controllers;

use App\Models\Materia;
use App\Models\Pnf;
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    public function obtenerMaterias($pnf_id)
    {
        // Obtener las materias asociadas al PNF
        $pnf = Pnf::findOrFail($pnf_id);
        $materias = $pnf->materias;  // Suponiendo que hay una relación definida en el modelo Pnf

        // Retornar las materias en formato JSON
        return response()->json([
            'materias' => $materias
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\PNF;
use App\Models\Materia;
use Illuminate\Http\Request;

class PNFController extends Controller
{
    public function index()
    {
        $pnfs = PNF::all();  // Obtén todos los PNF
        return view('pnfs.index', compact('pnfs'));  // Pasa la variable a la vista
    }

    /* ------------------------------------------------------------------------------------------------------------------ */

    public function create()
    {
        return view('pnfs.create');  // Vista para crear un nuevo PNF
    }

    /* ------------------------------------------------------------------------------------------------------------------ */

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'materias' => 'required|array',
            'materias.*' => 'string|max:255'
        ]);

        $pnf = PNF::create(['nombre' => $request->nombre]);

        foreach ($request->materias as $materia) {
            Materia::create(['nombre' => $materia, 'pnf_id' => $pnf->id]);
        }

        return redirect()->route('pnfs.index')->with('mensaje', 'Se añadió el P.N.F. correctamente.');
    }

    /* ------------------------------------------------------------------------------------------------------------------ */

    public function show($id)
    {
        // Obtener el PNF con sus materias asociadas
        $pnf = PNF::with('materias')->findOrFail($id);
        
        // Retornar la vista con los datos
        return view('pnfs.show', compact('pnf'));
    }

    /* ------------------------------------------------------------------------------------------------------------------ */

    public function edit($id)
    {
        $pnf = PNF::with('materias')->findOrFail($id);  // Obtener el PNF con sus materias asociadas
        return view('pnfs.edit', compact('pnf'));  // Pasar el PNF a la vista
    }

    /* ------------------------------------------------------------------------------------------------------------------ */

    public function update(Request $request, $id)
    {
        $pnf = PNF::findOrFail($id);

        // Validar los datos del PNF
        $request->validate([
            'nombre' => 'required|string|max:255',
            'materias' => 'required|array',
            'materias.*' => 'string|max:255',
        ]);

        // Actualizar el PNF
        $pnf->update([
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion', ''),
        ]);

        // Procesar las materias enviadas
        $materiasIds = [];
        foreach ($request->input('materias', []) as $materiaId => $materiaNombre) {
            // Si la materia es nueva (id 'new-*'), creamos una nueva
            if (strpos($materiaId, 'new-') === 0) {
                $materia = Materia::create([
                    'nombre' => $materiaNombre,
                    'pnf_id' => $pnf->id,
                ]);
                $materiasIds[] = $materia->id;
            } else {
                // Si la materia existe, la actualizamos
                $materia = Materia::find($materiaId);
                if ($materia) {
                    $materia->update(['nombre' => $materiaNombre]);
                    $materiasIds[] = $materia->id;
                }
            }
        }

        // Eliminar las materias que ya no están en el formulario
        $pnf->materias()->whereNotIn('id', $materiasIds)->delete();

        // Redirigir al show con un mensaje de éxito
        return redirect()->route('pnfs.index', $pnf->id)->with('mensaje', 'PNF actualizado correctamente.');
    }

/* ------------------------------------------------------------------------------------------------------------------ */

    public function destroy($id)
    {
        // Obtener el PNF con sus materias asociadas
        $pnf = PNF::findOrFail($id);

        // Eliminar las materias asociadas
        $pnf->materias()->delete();

        // Eliminar el PNF
        $pnf->delete();

        // Redirigir al índice con un mensaje de éxito
        return redirect()->route('pnfs.index')->with('eliminar', 'eliminar');
    }

}

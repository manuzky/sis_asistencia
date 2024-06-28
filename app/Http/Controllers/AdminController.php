<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\Models\Cargo;
use App\Models\Miembro;
use App\Models\User;
use App\Models\Asistencia;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index(){
        $cargos = Cargo::all();
        $miembros = Miembro::all();
        $usuario = User::all();
        $asistencias = Asistencia::all();
        return view('index', [
            'cargos' => $cargos,
            'miembros' => $miembros,
            'usuario' => $usuario,
            'asistencias' => $asistencias,
        ]);
    }

    public function registrarAsistencia(Request $request) {
        $cedula = $request->input('cedula');
        $tipo = $request->input('tipo');
    
        $miembro = Miembro::where('cedula', $cedula)->first();
    
        if ($miembro) {
            $fechaHoy = Carbon::now()->toDateString();
            $horaActual = Carbon::now()->toTimeString();
    
            if ($tipo == 'entrada') {
                // Verificar si existe una asistencia sin hora de salida
                $asistenciaPendiente = Asistencia::where('miembro_id', $miembro->id)
                                        ->whereNull('hora_salida')
                                        ->where('fecha', $fechaHoy)
                                        ->first();
    
                if ($asistenciaPendiente) {
                    return redirect()->back()->with('error', 'Ya existe una entrada registrada para este miembro hoy.');
                }
    
                // Crear una nueva asistencia para entrada
                $asistencia = new Asistencia;
                $asistencia->fecha = $fechaHoy;
                $asistencia->miembro_id = $miembro->id;
                $asistencia->hora_entrada = $horaActual;
                $asistencia->save();
    
                // Mostrar SweetAlert después de guardar
                Alert::success('¡Éxito!', 'Entrada registrada correctamente.');
    
            } elseif ($tipo == 'salida') {
                // Buscar la última asistencia del día para actualizar la salida
                $asistencia = Asistencia::where('miembro_id', $miembro->id)
                                ->where('fecha', $fechaHoy)
                                ->whereNotNull('hora_entrada')
                                ->whereNull('hora_salida')
                                ->orderBy('created_at', 'desc')
                                ->first();
    
                if ($asistencia) {
                    $asistencia->hora_salida = $horaActual;
                    $asistencia->save();
    
                    // Mostrar SweetAlert después de guardar
                    Alert::success('¡Éxito!', 'Salida registrada correctamente.');
    
                } else {
                    return redirect()->back()->with('error', 'No se encontró una entrada previa para este miembro.');
                }
            }
    
            // Redirigir a la vista 'asistencias'
            return redirect()->route('asistencias.index')->with('success', 'Asistencia registrada correctamente.');
    
        } else {
            return redirect()->back()->with('error', 'Miembro no encontrado.');
        }
    }
}
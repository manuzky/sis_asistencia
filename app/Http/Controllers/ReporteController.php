<?php

namespace App\Http\Controllers;

use App\Models\Reporte;
use App\Models\Asistencia;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;

class ReporteController extends Controller
{
        public function __construct()
    {
        $this->middleware('can:reportes')->only('index');
        $this->middleware('can:reportes.asistencias')->only('pdf', 'pdf_fechas');
    }

/* ---------------------------------------------------------------------------------------------------------------- */

    public function index()
    {
        return view('reportes.index');
    }

/* ---------------------------------------------------------------------------------------------------------------- */

    public function pdf()
    {
        $asistencias = Asistencia::paginate();
        $pdf = Pdf::loadView('reportes.pdf', ['asistencias'=>$asistencias]);

        return $pdf->stream();
    }

/* ---------------------------------------------------------------------------------------------------------------- */

    public function pdf_fechas(Request $request)
    {
        $fi = $request->fi;
        $ff = $request->ff;
        $asistencias = Asistencia::where('fecha', '>=', $fi)
            ->where('fecha', '<=', $ff)
            ->get();
        $pdf = Pdf::loadView('reportes.pdf_fechas', ['asistencias'=>$asistencias]);

        return $pdf->stream();
    }

}

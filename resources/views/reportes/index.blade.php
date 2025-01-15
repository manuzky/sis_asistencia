@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <h1>Reporte de asistencias</h1>

        <div class="row">
            <div class="col-sm-12">
                <div class="card card-primary shadow">
                    <div class="card-header">
                        <h3 class="card-title text-center">Seleccione la opción que desea imprimir</h3>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="text-center mt-2">
                                <button id="btn-general" class="btn btn-info mx-2">Reporte General</button>
                                <button id="btn-cargo" class="btn btn-success mx-2">Reporte por Cargo</button>
                                <button id="btn-pnf" class="btn btn-primary mx-2">Reporte por PNF</button>
                            </div>


                            {{-- IMPRIMIR REPORTE GENERAL --}}
                            <div id="section-general" class="report-section row" style="display: block;">
                                <div class="col-md-12 mt-4">
                                    <h4 class="text-center">Reporte general de asistencias</h4>
                                <div class="row">
                                    <div class="col-md-4 col-sm-6 col-12">
                                        <div class="info-box" style="height: 90%">
                                            <span class="info-box-icon bg-info">
                                                <a>
                                                    <i class="bi bi-printer"></i>
                                                </a>
                                            </span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Reporte general</span>
                                                <form action="{{ url('reportes/pdf') }}" method="GET">
                                                    <button type="submit" class="btn btn-primary mt-2">IMPRIMIR</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>

                                <div class="col-md-12 mt-4">
                                    <h4 class="text-center">Reporte general por fecha</h4>
                                </div>
                                <div class="col-md-8 col-sm-6 col-12">
                                    <div class="info-box" style="height: 90%">
                                        <span class="info-box-icon bg-danger">
                                            <a>
                                                <i class="bi bi-printer"></i>
                                            </a>
                                        </span>
                                        <div class="info-box-content">
                                            <form action="{{url('reportes/pdf_fechas')}}" method="GET">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="">Fecha Inicio</label>
                                                        <input type="date" name="fi" class="form-control">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="">Fecha Final</label>
                                                        <input type="date" name="ff" class="form-control">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div style="height: 37px"></div>
                                                        <button type="submit" class="btn btn-primary">Generar reporte</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>


                            {{-- IMPRIMIR REPORTE POR CARGOS --}}
                            <div id="section-cargo" class="report-section row" style="display: none;">
                                <div class="col-md-12 mt-4">
                                    <h4 class="text-center">Seleccionar por cargo</h4>
                                    <div class="row">
                                        @php
                                            // Obtener los cargos desde la base de datos
                                            use App\Models\Cargo;
                                            $cargos = Cargo::all();
                                        @endphp

                                        @foreach ($cargos as $cargo)
                                            {{-- Verificar si el cargo no es "Desarrollador" --}}
                                            @if ($cargo->nombre_cargo != 'Desarrollador')
                                                <div class="col-md-4">
                                                    <div class="info-box" style="height: 90%">
                                                        <span class="info-box-icon bg-success">
                                                            <a>
                                                                <i class="bi bi-printer"></i>
                                                            </a>
                                                        </span>
                                                        <div class="info-box-content">
                                                            <span class="info-box-text">Reporte de {{ $cargo->nombre_cargo }}</span>
                                                            <form action="{{ url('reportes/pdf_cargo') }}" method="GET">
                                                                <input type="hidden" name="cargo" value="{{ $cargo->id }}">
                                                                <button type="submit" class="btn btn-primary mt-2">IMPRIMIR</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>

                                <hr>

                                <!-- Reporte por fecha y cargo -->
                                <div class="col-md-12 mt-4">
                                    <h4 class="text-center">Reporte de un cargo por fecha</h4>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <div class="info-box" style="height: 90%">
                                        <span class="info-box-icon bg-danger">
                                            <a>
                                                <i class="bi bi-printer"></i>
                                            </a>
                                        </span>
                                        <div class="info-box-content">
                                            <form action="{{ url('reportes/pdf_fechas_cargo') }}" method="GET">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label for="">Seleccionar Cargo</label>
                                                        <select name="cargo" class="form-control">
                                                            @foreach ($cargos as $cargo)
                                                                {{-- Verificar si el cargo no es "Desarrollador" --}}
                                                                @if ($cargo->nombre_cargo != 'Desarrollador')
                                                                    <option value="{{ $cargo->id }}">{{ $cargo->nombre_cargo }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="">Fecha Inicio</label>
                                                        <input type="date" name="fi" class="form-control">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="">Fecha Final</label>
                                                        <input type="date" name="ff" class="form-control">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div style="height: 37px"></div>
                                                        <button type="submit" class="btn btn-primary">Generar reporte</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>




                            {{-- IMPRIMIR REPORTE POR PNF --}}
                            <div id="section-pnf" class="report-section row" style="display: none;">
                                <div class="col-md-12 mt-4">
                                    <h4 class="text-center">Seleccionar por PNF</h4>
                                    <div class="row">
                                        <!-- Simulando los PNF -->
                                        @php
                                            $pnfs = ['Ingeniería de Sistemas', 'Administración', 'Contaduría'];
                                        @endphp

                                        @foreach ($pnfs as $pnf)
                                            <div class="col-md-4">
                                                <div class="info-box" style="height: 90%">
                                                    <span class="info-box-icon bg-info">
                                                        <a>
                                                            <i class="bi bi-printer"></i>
                                                        </a>
                                                    </span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text">Reporte de {{ $pnf }}</span>
                                                        <form action="{{ url('reportes/pdf_pnf') }}" method="GET">
                                                            <input type="hidden" name="pnf" value="{{ $pnf }}">
                                                            <button type="submit" class="btn btn-primary mt-2">IMPRIMIR</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <hr>

                                <div class="col-md-12 mt-4">
                                    <h4 class="text-center">Reporte de un PNF por fecha</h4>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <div class="info-box" style="height: 90%">
                                        <span class="info-box-icon bg-danger">
                                            <a >
                                                <i class="bi bi-printer"></i>
                                            </a>
                                        </span>
                                        <div class="info-box-content">
                                            <form action="{{ url('reportes/pdf_fechas_pnf') }}" method="GET">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label for="">Seleccionar PNF</label>
                                                        <select name="pnf" class="form-control">
                                                            @foreach ($pnfs as $pnf)
                                                                <option value="{{ $pnf }}">{{ $pnf }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="">Fecha Inicio</label>
                                                        <input type="date" name="fi" class="form-control">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="">Fecha Final</label>
                                                        <input type="date" name="ff" class="form-control">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div style="height: 37px"></div>
                                                        <button type="submit" class="btn btn-primary">Generar reporte</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- SCRIPTS --}}
    <script>
        document.getElementById('btn-general').addEventListener('click', function() {
        toggleSections('general');
    });

    document.getElementById('btn-cargo').addEventListener('click', function() {
        toggleSections('cargo');
    });

    document.getElementById('btn-pnf').addEventListener('click', function() {
        toggleSections('pnf');
    });

    function toggleSections(section) {
        // Ocultar todas las secciones
        const sections = document.querySelectorAll('.report-section');
        sections.forEach(function(sec) {
            sec.style.display = 'none';
        });

        // Mostrar la sección seleccionada
        document.getElementById('section-' + section).style.display = 'block';
    }
    </script>
@endsection

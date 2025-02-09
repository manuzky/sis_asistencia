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
                                <button id="btn-cargo" class="btn btn-success mx-2">Reporte por Personal</button>
                                {{-- <button id="btn-pnf" class="btn btn-primary mx-2">Reporte por PNF</button> --}}
                            </div>


                            {{-- IMPRIMIR REPORTE GENERAL --}}
                            <div id="section-general" class="report-section row" style="display: block;">
                                <div class="col-md-12 mt-4">
                                    <h4 class="text-center">Reporte general de asistencias</h4>
                                    <div class="row">
                                        <div class="col-md-4 col-sm-6 col-12">
                                            <div class="info-box" style="height: 100%">
                                                <span class="info-box-icon bg-info">
                                                    <a>
                                                        <i class="bi bi-printer"></i>
                                                    </a>
                                                </span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Reporte general</span>
                                                    <form action="{{ url('reportes/pdf') }}" method="GET">
                                                        {{-- SELECCIÓN DE TURNOS --}}
                                                        <div class="form-group">
                                                            <label><b>Seleccionar turnos:</b></label>
                                                            <div class="row">
                                                                @foreach($turnos as $turno)
                                                                    <div class="ml-2">
                                                                        <div class=" checkbox-wrapper-27">
                                                                            <label class="checkbox">
                                                                                <input type="checkbox" name="turnos[]" value="{{ $turno->id }}" 
                                                                                    {{ in_array($turno->id, $turnosAsignados ?? []) ? 'checked' : '' }}>
                                                                                <span class="checkbox__icon"></span>
                                                                                {{ $turno->nombre }}
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                            
                                                        </div>
                                                        <button type="submit" class="btn btn-primary ">IMPRIMIR</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                {{-- IMPRIMIR REPORTE GENERAL POR FECHA --}}
                                <div class="col-md-12 mt-4">
                                    <h4 class="text-center">Reporte general por fecha</h4>
                                </div>
                                <div class="col-md-12 col-sm-6 col-12">
                                    <div class="info-box" style="height: 100%">
                                        <span class="info-box-icon bg-danger">
                                            <a>
                                                <i class="bi bi-printer"></i>
                                            </a>
                                        </span>
                                        <div class="info-box-content">
                                            <form action="{{ url('reportes/pdf_fechas') }}" method="GET">
                                                <div class="row d-flex align-items-end">
                                                    {{-- FECHA INICIO --}}
                                                    <div class="col-md-4">
                                                        <label for=""><b>Fecha Inicio</b></label>
                                                        <input type="date" name="fi" class="form-control">
                                                    </div>

                                                    {{-- FECHA FINAL --}}
                                                    <div class="col-md-4">
                                                        <label for=""><b>Fecha Final</b></label>
                                                        <input type="date" name="ff" class="form-control">
                                                    </div>

                                                    {{-- SELECCIÓN DE TURNOS --}}
                                                    <div class="col-md-4">
                                                        <label><b>Seleccionar turnos:</b></label>
                                                        <div class="d-flex flex-wrap">
                                                            @foreach($turnos as $turno)
                                                                <div class="mr-3">
                                                                    <div class="checkbox-wrapper-27">
                                                                        <label class="checkbox">
                                                                            <input type="checkbox" name="turnos[]" value="{{ $turno->id }}">
                                                                            <span class="checkbox__icon"></span>
                                                                            {{ $turno->nombre }}
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- BOTÓN GENERAR REPORTE --}}
                                                <div class="text-center mt-3">
                                                    <button type="submit" class="btn btn-primary">GENERAR REPORTE</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            {{-- IMPRIMIR REPORTE POR CARGOS --}}
                            <div id="section-cargo" class="report-section row" style="display: none;">
                                <div class="col-md-12 mt-4">
                                    <h4 class="text-center">Seleccionar por personal</h4>
                                    <div class="row">
                                        @php
                                            use App\Models\Cargo;
                                            $cargos = Cargo::all();
                                        @endphp

                                        @foreach ($cargos as $cargo)
                                            @if ($cargo->nombre_cargo != 'Desarrollador')
                                                <div class="col-md-4">
                                                    <div class="info-box" style="height: 100%">
                                                        <span class="info-box-icon bg-success">
                                                            <a>
                                                                <i class="bi bi-printer"></i>
                                                            </a>
                                                        </span>
                                                        <div class="info-box-content">
                                                            <span class="info-box-text">Reporte de {{ $cargo->nombre_cargo }}</span>
                                                            <form action="{{ url('reportes/pdf_cargo') }}" method="GET">
                                                                <input type="hidden" name="cargo" value="{{ $cargo->id }}">
                                                                
                                                                {{-- SELECCIÓN DE TURNOS --}}
                                                                <div class="form-group">
                                                                    <label><b>Seleccionar turnos:</b></label>
                                                                    <div class="row">
                                                                        @foreach($turnos as $turno)
                                                                            <div class="ml-2">
                                                                                <div class="checkbox-wrapper-27">
                                                                                    <label class="checkbox">
                                                                                        <input type="checkbox" name="turnos[]" value="{{ $turno->id }}">
                                                                                        <span class="checkbox__icon"></span>
                                                                                        {{ $turno->nombre }}
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>

                                                                <button type="submit" class="btn btn-primary">IMPRIMIR</button>
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
                                    <h4 class="text-center">Reporte de un personal por fecha</h4>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <div class="info-box" style="height: 100%">
                                        <span class="info-box-icon bg-danger">
                                            <a>
                                                <i class="bi bi-printer"></i>
                                            </a>
                                        </span>
                                        <div class="info-box-content">
                                            <form action="{{ url('reportes/pdf_fechas_cargo') }}" method="GET">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label for="">Seleccionar Personal</label>
                                                        <select name="cargo" class="form-control">
                                                            @foreach ($cargos as $cargo)
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

                                                    {{-- SELECCIÓN DE TURNOS --}}
                                                    <div class="col-md-3">
                                                        <label><b>Seleccionar turnos:</b></label>
                                                        <div class="d-flex flex-wrap">
                                                            @foreach($turnos as $turno)
                                                                <div class="mr-3">
                                                                    <div class="checkbox-wrapper-27">
                                                                        <label class="checkbox">
                                                                            <input type="checkbox" name="turnos[]" value="{{ $turno->id }}">
                                                                            <span class="checkbox__icon"></span>
                                                                            {{ $turno->nombre }}
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- BOTÓN GENERAR REPORTE --}}
                                                <div class="text-center mt-3">
                                                    <button type="submit" class="btn btn-primary">Generar reporte</button>
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

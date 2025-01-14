@extends('layouts.admin')

@section('content')
    {{-- <div class="container card card-body">
        <h3>Detalles del Horario</h3>

        <h5>Horario para la sección: {{ $horario->seccion }}</h5>
        <p><strong>Turno:</strong> {{ $horario->turno }}</p>
        <p><strong>Trayecto:</strong> {{ $horario->trayecto }}</p>
        <p><strong>Semestre:</strong> {{ $horario->semestre }}</p>
        <p><strong>PNF:</strong> {{ $horario->pnf->nombre }}</p>

        <h5>Horarios</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Hora</th>
                    @foreach ($dias as $dia)
                        <th>{{ $dia }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($horas as $hora)
                    <tr>
                        <td>{{ $hora }}</td>
                        @foreach ($dias as $dia)
                            <td>
                                @php
                                    $materiaProfesor = $horarioMaterias
                                        ->where('dia', $dia)
                                        ->where('hora', $hora)
                                        ->first();
                                @endphp

                                @if ($materiaProfesor)
                                    <strong>{{ $materiaProfesor->materia->nombre }}</strong><br>
                                    <small>{{ $materiaProfesor->profesor->nombre_apellido ?? 'Sin Profesor' }}</small>
                                @else
                                    <em>Sin asignar</em>
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('horarios.index') }}" class="btn btn-primary">Volver</a>
    </div> --}}

    <div class="container">
        <h3 class="mb-4">Detalles del Horario</h3>

        <!-- Información del horario con estilo profesional -->
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <h6 class="text-uppercase font-weight-bold">Turno</h6>
                        <p class="mb-0">{{ $horario->turno }}</p>
                    </div>
                    <div class="col-md-3">
                        <h6 class="text-uppercase font-weight-bold">Trayecto</h6>
                        <p class="mb-0">{{ $horario->trayecto }}</p>
                    </div>
                    <div class="col-md-3">
                        <h6 class="text-uppercase font-weight-bold">Semestre</h6>
                        <p class="mb-0">{{ $horario->semestre }}</p>
                    </div>
                    <div class="col-md-3">
                        <h6 class="text-uppercase font-weight-bold">PNF</h6>
                        <p class="mb-0">{{ $horario->pnf->nombre }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de horarios -->
        <div class="card card-body">
            <h5>Horarios</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Hora</th>
                            @foreach ($dias as $dia)
                                <th>{{ $dia }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($horas as $hora)
                            <tr>
                                <td class="fw-bold">{{ $hora }}</td>
                                @foreach ($dias as $dia)
                                    <td>
                                        @php
                                            $materiaProfesor = $horarioMaterias
                                                ->where('dia', $dia)
                                                ->where('hora', $hora)
                                                ->first();
                                        @endphp

                                        @if ($materiaProfesor)
                                            <strong>{{ $materiaProfesor->materia->nombre }}</strong><br>
                                            <small
                                                class="text-muted">{{ $materiaProfesor->profesor->nombre_apellido ?? 'Sin Profesor' }}</small>
                                        @else
                                            <em class="text-muted">Sin asignar</em>
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <a href="{{ route('horarios.index') }}" class="btn btn-primary">Volver</a>
    </div>
@endsection

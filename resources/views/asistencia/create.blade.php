@extends('layouts.admin')
@section('content')
    <section class="content container-fluid" >
        <h1>Nueva asistencia</h1>

        <div class="row">
            <div class="col-md-11">
                @includeif('partials.errors')
                <div class="card card-primary shadow">
                    <div class="card-header">
                        <span class="card-title">Creación de asistencias</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('asistencias.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            <div class="box box-info padding-1">
                                <div class="box-body">
                                    <h6 style="color: red">Los campos con (<b>*</b>) son obligatorios</h6>
                                    
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="cedula">Cédula</label>
                                                <input type="text" id="cedula" name="cedula" class="form-control" required>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ Form::label('Seleccionar Miembro') }}
                                                <label for="miembro_id" style="color: red;">*</label>
                                                <select id="miembro_id" class="form-control" name="miembro_id" required>
                                                    <option value="" disabled selected>-- SELECCIONAR MIEMBRO --</option>
                                                    @foreach($miembros as $miembro)
                                                        <option value="{{ $miembro->id }}" 
                                                                data-cedula="{{ $miembro->cedula }}" 
                                                                data-cargo="{{ $miembro->cargo->nombre_cargo }}">
                                                            {{ $miembro->nombre_apellido }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="cargo">Personal</label>
                                                <input type="text" id="cargo" class="form-control" disabled>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fecha">Fecha <span style="color: red;">*</span></label>
                                                <div class="input-group date" id="datepicker">
                                                    <input type="text" name="fecha" value="{{ old('fecha', $asistencia->fecha) }}" class="form-control{{ $errors->has('fecha') ? ' is-invalid' : '' }}" placeholder="Fecha de asistencia">
                                                    <span class="input-group-append">
                                                        <span class="input-group-text bg-white">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </span>
                                                </div>
                                                {!! $errors->first('fecha', '<div class="invalid-feedback">:message</div>') !!}
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="hora_entrada">Hora de Entrada <span style="color: red;">*</span></label>
                                                <input type="time" name="hora_entrada" value="{{ old('hora_entrada', $asistencia->hora_entrada) }}" class="form-control{{ $errors->has('hora_entrada') ? ' is-invalid' : '' }}">
                                                {!! $errors->first('hora_entrada', '<div class="invalid-feedback">:message</div>') !!}
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="hora_salida">Hora de Salida</label>
                                                <input type="time" name="hora_salida" value="{{ old('hora_salida', $asistencia->hora_salida) }}" class="form-control{{ $errors->has('hora_salida') ? ' is-invalid' : '' }}">
                                                {!! $errors->first('hora_salida', '<div class="invalid-feedback">:message</div>') !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="box-footer mt-4 ">
                                    <a href="{{url('asistencias')}}" class="btn btn-danger">Cancelar</a>
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

{{-- SCRIPTS --}}
<div>
    <script type="text/javascript">
    // Crear un objeto con las cédulas y sus datos
    var miembros = {
        @foreach($miembros as $miembro)
            "{{ $miembro->cedula }}": {
                id: "{{ $miembro->id }}",
                nombre: "{{ $miembro->nombre_apellido }}",
                cargo: "{{ $miembro->cargo->nombre_cargo }}"
            },
        @endforeach
    };

    // Detectar cuando se escribe en el campo de cédula
    document.getElementById('cedula').addEventListener('input', function() {
        var cedulaIngresada = this.value.trim();
        var selectMiembro = document.getElementById('miembro_id');

        if (miembros[cedulaIngresada]) {
            // Rellenar datos automáticamente
            document.getElementById('cargo').value = miembros[cedulaIngresada].cargo;
            selectMiembro.value = miembros[cedulaIngresada].id;
        } else {
            // Limpiar los campos si la cédula no existe
            document.getElementById('cargo').value = '';
            selectMiembro.value = '';
        }
    });

    // Detectar cuando se selecciona un miembro de la lista
    document.getElementById('miembro_id').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];

        if (selectedOption.value) {
            document.getElementById('cedula').value = selectedOption.getAttribute('data-cedula');
            document.getElementById('cargo').value = selectedOption.getAttribute('data-cargo');
        } else {
            document.getElementById('cedula').value = '';
            document.getElementById('cargo').value = '';
        }
    });
    </script>
        
    
    {{-- DATEPICKER EN ESPAÑOL --}}
    <script type="text/javascript">
        $(function() {
            $('#datepicker').datepicker({
                language: 'es' // Establecer el idioma en español
            });
        });
    </script>
</div>
@endsection

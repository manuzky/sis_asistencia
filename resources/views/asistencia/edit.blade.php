@extends('layouts.admin')
@section('content')
    <section class="content container-fluid">
        <h1>Actualización de asistencia</h1>
        <div class="row">
            <div class="col-md-12">
                @includeif('partials.errors')
                <div class="card card-primary shadow">
                    <div class="card-header">
                        <span class="card-title"> Actualizar asistencia</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('asistencias.update', $asistencia->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            <div class="box box-info padding-1">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('Miembros') }}
                                            <label for="miembro_id" style="color: red;">*</label>
                                            {{ Form::select('miembro_id', $miembros, $asistencia->miembro_id, ['class' => 'form-control' . ($errors->has('miembro_id') ? ' is-invalid' : ''), 'placeholder' => '-- MIEMBROS LISTADOS --']) }}
                                            {!! $errors->first('miembro_id', '<div class="invalid-feedback">:message</div>') !!}
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="hora_entrada">Hora de Entrada <span style="color: red;">*</span></label>
                                            <input type="time" name="hora_entrada" value="{{ old('hora_entrada', $asistencia->hora_entrada) }}" class="form-control{{ $errors->has('hora_entrada') ? ' is-invalid' : '' }}">
                                            {!! $errors->first('hora_entrada', '<div class="invalid-feedback">:message</div>') !!}
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fecha">Fecha <span style="color: red;">*</span></label>
                                            <div class="input-group date" id="datepicker">
                                                <input type="text" name="fecha" value="{{ old('fecha', \Carbon\Carbon::parse($asistencia->fecha)->format('d/m/Y')) }}" class="form-control{{ $errors->has('fecha') ? ' is-invalid' : '' }}" placeholder="Fecha de asistencia">

                                                <span class="input-group-append">
                                                    <span class="input-group-text bg-white">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                </span>
                                            </div>
                                            {!! $errors->first('fecha', '<div class="invalid-feedback">:message</div>') !!}
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="hora_salida">Hora de Salida <span style="color: red;">*</span></label>
                                            <input type="time" name="hora_salida" value="{{ old('hora_salida', $asistencia->hora_salida) }}" class="form-control{{ $errors->has('hora_salida') ? ' is-invalid' : '' }}">
                                            {!! $errors->first('hora_salida', '<div class="invalid-feedback">:message</div>') !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="box-footer mt20">
                                    <a href="{{url('asistencias')}}" class="btn btn-danger">Cancelar</a>
                                    <button type="submit" class="btn btn-success">Actualizar</button>
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
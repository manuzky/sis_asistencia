@extends('layouts.admin')
@section('content')
    <section class="content container-fluid">
        <h1>Datos de la asistencia</h1>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary shadow">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Detalle de la Asistencia</span>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="box box-info padding-1">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('Miembros') }}
                                        {{ Form::select('miembro_id', $miembros, $asistencia->miembro_id, ['class' => 'form-control' . ($errors->has('miembro_id') ? ' is-invalid' : ''), 'placeholder' => '-- MIEMBROS LISTADOS --', 'disabled' => 'disabled']) }}
                                        {!! $errors->first('miembro_id', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hora_entrada">Hora de Entrada </label>
                                        <input type="time" name="hora_entrada" value="{{ old('hora_entrada', $asistencia->hora_entrada) }}" class="form-control{{ $errors->has('hora_entrada') ? ' is-invalid' : '' }}" disabled>
                                        {!! $errors->first('hora_entrada', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fecha">Fecha de ingreso</label>
                                        <div class="input-group date" id="datepicker">
                                            <input type="text" name="fecha" value="{{ old('fecha', \Carbon\Carbon::parse($asistencia->fecha)->format('d/m/Y')) }}" class="form-control{{ $errors->has('fecha') ? ' is-invalid' : '' }}" placeholder="Fecha de asistencia" disabled>

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
                                        <label for="hora_salida">Hora de Salida </label>
                                        <input type="time" name="hora_salida" value="{{ old('hora_salida', $asistencia->hora_salida) }}" class="form-control{{ $errors->has('hora_salida') ? ' is-invalid' : '' }}" disabled>
                                        {!! $errors->first('hora_salida', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="usuario">Ingresado por</label>
                                        <input type="text" name="usuario" value="{{ $asistencia->user->name }}" class="form-control" disabled>
                                    </div>
                                </div>
                                
                                
                                
                                                             

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="updated_at">Última modificación </label>
                                        <input type="text" name="updated_at" value="{{ old('updated_at', $asistencia->updated_at->format('d/m/Y — H:i:s')) }}" class="form-control{{ $errors->has('updated_at') ? ' is-invalid' : '' }}" disabled>
                                        {!! $errors->first('updated_at', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 ">
                            <a href="{{url('asistencias')}}" class="btn btn-danger">Volver</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

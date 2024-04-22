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
                                <div class="box-body">
                                    <h6 style="color: red">Los campos con (<b>*</b>) son obligatorios</h6>
                                    
                                    <div class="form-group">
                                        {{ Form::label('fecha') }}
                                        <label for="miembro_id" style="color: red;">*</label>
                                        {{ Form::date('fecha', $asistencia->fecha, ['class' => 'form-control' . ($errors->has('fecha') ? ' is-invalid' : ''), 'placeholder' => 'Fecha']) }}
                                        {!! $errors->first('fecha', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('Miembros') }}
                                        <label for="fecha" style="color: red;">*</label>
                                        {{ Form::select('miembro_id', $miembros, $asistencia->miembro_id, ['class' => 'form-control' . ($errors->has('miembro_id') ? ' is-invalid' : ''), 'placeholder' => '-- MIEMBROS LISTADOS --']) }}
                                        {!! $errors->first('miembro_id', '<div class="invalid-feedback">:message</div>') !!}
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
@endsection

@extends('layouts.admin')
@section('content')
    <section class="content container-fluid" >
        <h1>Nueva asistencia</h1>

        <div class="row">
            <div class="col-md-12">
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
                                    <div class="form-group">
                                        {{ Form::label('Miembros') }}
                                        <label for="miembro_id" style="color: red;">*</label>
                                        {{ Form::select('miembro_id', $miembros, $asistencia->miembro_id, ['class' => 'form-control' . ($errors->has('miembro_id') ? ' is-invalid' : ''), 'placeholder' => '-- MIEMBROS LISTADOS --']) }}
                                        {!! $errors->first('miembro_id', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>

                                    <label for="">Fecha <label for="fecha" style="color: red;">*</label></label>
                                    <div class="input-group date" id="datepicker">
                                        <input type="text" name="fecha" value="{{ $asistencia->fecha }}" class="form-control{{ $errors->has('fecha') ? ' is-invalid' : '' }}" placeholder="Fecha de asistencia">
                                        <span class="input-group-append">
                                            <span class="input-group-text bg-white">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </span>
                                    </div>
                                    {!! $errors->first('fecha', '<div class="invalid-feedback">:message</div>') !!}
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

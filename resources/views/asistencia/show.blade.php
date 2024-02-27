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
                        
                        <div class="form-group">
                            <strong>Fecha:</strong>
                            {{ $asistencia->fecha }}
                        </div>
                        <div class="form-group">
                            <strong>Miembro Id:</strong>
                            {{ $asistencia->miembro_id }}
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

@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <h1>Reporte de asistencias</h1>

        <div class="row">
            <div class="col-sm-12">
                <div class="card card-primary shadow">
                    <div class="card-header">
                        <h3 class="card-title text-center">Seleccione la opción que desee imprimir</h3>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="row">

                                @can('reportes.asistencias')
                                <div class="col-md-3 col-sm-6 col-12" >
                                    <div class="info-box" style="height: 92px">
                                        <span class="info-box-icon bg-info">
                                            <a href="{{url('reportes/pdf')}}">
                                                <i class="bi bi-printer"></i>
                                            </a>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Imprimir reporte</span>
                                            <span class="info-box-number">Asistencias</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-warning">
                                            <a href="{{url('reportes/pdf')}}">
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
                                @endcan

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    @if($message = Session::get('mensaje'))
    <script>
            Swal.fire({
                title: "¡Felicidades!",
                text: "{{$message}}",
                icon: "success"
            });
    </script>
    @endif

@endsection

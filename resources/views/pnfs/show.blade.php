@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 2%">
        <h1>PNF: {{$pnf->nombre}}</h1>

        <br>
        <div class="row">
            <div class="col-md-11">
                <div class="card card-primary shadow">
                    <div class="card-header">
                        <h3 class="card-title text-center">Datos del PNF</h3>
                    </div>
                    
                    <div class="card-body" style="display: block;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Nombre del PNF</label>
                                            <input type="text" name="nombre_pnf" value="{{$pnf->nombre}}" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for=""></label>
                                            <p>{{$pnf->descripcion}}</p>
                                        </div>
                                    </div>
                                </div>

                                <h4>Materias asociadas</h4>
                                <div class="row">
                                    @foreach($pnf->materias as $materia)
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Materia</label>
                                                <input type="text" class="form-control" value="{{$materia->nombre}}" disabled>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
    
                        <hr>
    
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <a href="{{url('pnfs')}}" class="btn btn-danger">Volver</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>  
            </div>
        </div>
    </div>
@endsection

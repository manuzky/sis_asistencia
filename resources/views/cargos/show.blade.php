@extends('layouts.admin')
@section('content')
    <div class="content" style="margin-left: 2%">
        <h1>Personal: {{$cargo->nombre_cargo}}</h1>

        <br>
        <div class="row">
            <div class="col-md-11">
                <div class="card card-primary shadow">
                    <div class="card-header">
                        <h3 class="card-title text-center">Datos a agregar</h3>
                    </div>
                    
                    <div class="card-body" style="display: block;">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Nombre del personal</label>
                                                <input type="text" name="nombre_cargo" value="{{$cargo->nombre_cargo}}" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Descripción</label>
                                                <p>{{$cargo->descripcion_cargo}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            <hr>
    
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <a href="{{url('cargos')}}" class="btn btn-danger">Volver</a>
                                    </div>
                                </div>
                            </div>

                    </div>
                </div>  
            </div>
        </div>
    </div>
@endsection
@extends('layouts.admin')
@section('content')
    <div class="content" style="margin-left: 2%">
        <h1>Actualización del cargo</h1>
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">
                <li>{{$error}}</li>
            </div>
        @endforeach
        <br>
        <div class="row">
            <div class="col-md-11">
                <div class="card card-primary shadow">
                    <div class="card-header">
                        <h3 class="card-title text-center">Modifique los datos</h3>
                    </div>
                    
                    <div class="card-body" style="display: block;">
                        <form action="{{url('/cargos', $cargo->id)}}" method="POST">
                            @csrf
                            {{method_field('PATCH')}}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Nombre del cargo</label><b style="color:red"> *</b>
                                                <input type="text" name="nombre_cargo" value="{{$cargo->nombre_cargo}}" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Fecha de ingreso</label><b style="color:red"> *</b>
                                                <input type="date" name="fecha_ingreso_cargo" value="{{$cargo->fecha_ingreso_cargo}}" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Descripción</label>
                                                <textarea class="form-control" name="descripcion_cargo" cols="30" rows="3">{{$cargo->descripcion_cargo}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            <hr>
    
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <a href="{{url('cargos')}}" class="btn btn-danger">Cancelar</a>
                                        <button type="submit" class="btn btn-success">Actualizar cargo</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>  
            </div>
        </div>
    </div>
@endsection
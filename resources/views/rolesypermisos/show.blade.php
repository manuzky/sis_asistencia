@extends('layouts.admin')
@section('content')
    <div class="content" style="margin-left: 2%">
        <h1>Detalles del rol</h1>

        <br>
        <div class="row">
            <div class="col-md-11">
                <div class="card card-primary shadow">
                    <div class="card-header">
                        <h3 class="card-title text-center">Detalles del Rol</h3>
                    </div>
                    
                    <div class="card-body" style="display: block;">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Nombre del rol</label>
                                            <input type="text" name="nombre_cargo" value="{{$role->name}}" class="form-control" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Descripción</label>
                                            <input type="text" name="rolesypermisos" value="{{$role->description}}" class="form-control" disabled>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4>Permisos asignados</h4>
                                            <ul>
                                                @foreach($role->permissions as $permission)
                                                    <li>{{$permission->description}}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <a href="{{url('rolesypermisos')}}" class="btn btn-danger">Volver</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>  
            </div>
        </div>
    </div>
@endsection

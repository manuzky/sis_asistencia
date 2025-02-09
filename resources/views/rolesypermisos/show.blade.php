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
                                            @foreach($role->permissions as $permission)
                                                <div class="form-group d-flex align-items-center ml-5">
                                                    <!-- Toggle Switch siempre activado y deshabilitado -->
                                                    <div class="checkbox-wrapper-31">
                                                        <input type="checkbox" checked disabled/>
                                                        <svg viewBox="0 0 35.6 35.6">
                                                            <circle class="background" cx="17.8" cy="17.8" r="17.8"></circle>
                                                            <circle class="stroke" cx="17.8" cy="17.8" r="14.37"></circle>
                                                            <polyline class="check" points="11.78 18.12 15.55 22.23 25.17 12.87"></polyline>
                                                        </svg>
                                                    </div>
                                                    <!-- Frase al lado del toggle -->
                                                    <span class="ml-2">{{ $permission->description }}</span>
                                                </div>
                                            @endforeach
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
